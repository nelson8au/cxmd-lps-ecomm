<?php

namespace app\channel\controller\api;

use app\common\controller\Api;
use app\channel\logic\OfficialAccount as OfficialAccountLogic;
use app\channel\model\WechatConfig;
use app\common\model\Member;
use app\common\model\MemberSync;
use app\common\model\QrcodeLogin;
use app\channel\model\WechatAutoReply;
use app\channel\facade\wechat\OfficialAccount;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Media;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Video;
use EasyWeChat\Kernel\Messages\Voice;
use thans\jwt\facade\JWTAuth;
use think\Exception;

/**
 * 微信公众号服务
 * Class WechatOfficaialAccount
 * @package app\channel\controller\service
 */
class WechatOfficialAccount extends Api
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取公众号配置
     */
    public function config()
    {
        //获取公众号配置
        $weixin_h5 = (new WechatConfig())->where('shopid', $this->params['shopid'])->field('title,desc,cover,qrcode,appid,auth_login')->find();
        if ($weixin_h5) {
            $weixin_h5 = $weixin_h5->toArray();
            $weixin_h5 = (new OfficialAccountLogic())->formatData($weixin_h5);
        }

        return $this->success('success', $weixin_h5);
    }

    /**
     * 微信回调
     */
    public function callback()
    {
        //实例化公众号
        $app = OfficialAccount::getApp();
        //获取消息类型
        $message = $app->server->getMessage();
        if (isset($message['MsgType'])) {
            $map = [
                ['status', '=', 1],
            ];
            switch ($message['MsgType']) {
                case 'event': //事件
                    $this->doEvent($message);
                    break;
                default:
                    //自动回复消息
                    $map[] = ['type', '=', 2];
                    $map[] = ['keyword', '=', $message['Content']];
                    $map[] = ['status', '=', 1];
                    $this->doMessage($message, $map);
                    break;
            }
            $app->server->serve();
        }
        //token 回调
        OfficialAccount::serverOAath();
    }

    /**
     * 公众号事件处理
     * @param $message
     */
    private function doEvent($message)
    {
        switch ($message['Event']) {
            case 'subscribe':
                //关注消息
                $map[] = ['type', '=', 1];
                $this->doMessage($message, $map);
                break;
            case 'scan':
                break;
        }
        //判断是否是扫码登录
        if (isset($message['EventKey'])) {
            $event_key = convert_url_query($message['EventKey']);
            if (isset($event_key['islogin'])) {
                //获取用户信息
                $user_info = OfficialAccount::getApp()->user->get($message['FromUserName']);
                //保存扫码信息
                $qrcode_login = [
                    'scene_key' => $event_key['scene_key'],
                    'metadata' => json_encode($user_info)
                ];
                $QrcodeLoginModel = (new QrcodeLogin());
                //是否登录过
                $has_login = $QrcodeLoginModel->where('scene_key', $event_key['scene_key'])->count();
                if ($has_login == 0) {
                    $QrcodeLoginModel->edit($qrcode_login);
                    //登录消息
                    $map[] = ['type', '=', 3];
                    $map[] = ['status', '=', 1];
                    $this->doMessage($message, $map);
                } else {
                    //消息通知
                    $msg = new Text('QR code has expired, please refresh and try again.');
                    OfficialAccount::getApp()->customer_service->message($msg)->to($message['FromUserName'])->send();
                }
            }
        }
    }

    /**
     * 公众号消息处理
     * @param $message
     * @param $map
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function doMessage($message, $map)
    {
        //获取平台配置消息
        $list = (new WechatAutoReply())->where($map)->order('sort', 'DESC')->order('id', 'DESC')->select()->toArray();
        foreach ($list as $item) {
            $msg = null;
            switch ($item['msg_type']) {
                case 'text':
                    $msg = new Text($item['text']);
                    break;
                case 'news':
                    if (isset($message['Event']) && $message['Event'] == 'subscribe') {
                        $msg = new Media($item['media_id'], 'mpnews');
                    } else {
                        $news = json_decode($item['material_json'], true);
                        $news = $news['content']['news_item'][0];
                        $items = [
                            new NewsItem([
                                'title' => $news['title'],
                                'description' => $news['digest'],
                                'url' => $news['url'],
                                'image' => $news['thumb_url']
                            ]),
                        ];
                        $msg = new News($items);
                    }
                    break;
                case 'image':
                    $msg = new Image($item['media_id']);
                    break;
                case 'voice':
                    $msg = new Voice($item['media_id']);
                    break;
                case 'video':
                    $msg = new Video($item['media_id']);
                    break;
            }
            //消息通知
            OfficialAccount::getApp()->customer_service->message($msg)->to($message['FromUserName'])->send();
        }
    }

    /**
     * 生成微信临时二维码
     * @param $scene_key
     * @return \think\response\Json
     */
    public static function qrcode($scene_key)
    {
        //模板调用
        $access_token = OfficialAccount::getToken();
        $qrcode_url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $access_token['access_token'];
        $qrcode_url .= "&islogin=1";
        $qrcode_url .= "&scene_key=" . $scene_key;
        $result = OfficialAccount::createQrcode($qrcode_url, 60 * 60);
        $ticket = $result['ticket'];
        $qrcode = OfficialAccount::getQrcodeUrl($ticket);
        $fp = fopen($qrcode, 'rb');
        ob_clean();
        fpassthru($fp);
    }

    /**
     * @title 扫码登录
     * @return \think\Response|void
     */
    public function scanLogin()
    {
        if (request()->isPost()) {
            $openid = input('post.openid');
            $scene_key = input('post.scene_key');
            $map = [
                ['openid', '=', $openid],
                ['type', '=', 'weixin_h5']
            ];
            $uid = MemberSync::where($map)->value('uid');
            $MemberModel = new Member();
            //初次扫码注册
            if (!$uid) {
                $oauth_info = (new QrcodeLogin())->where('scene_key', $scene_key)->value('metadata');
                if (!$oauth_info) {
                    return $this->error('No authorization information');
                }
                $oauth_info = json_decode($oauth_info, true);
                //开放平台ID
                $unionid = '';
                if(isset($oauth_info['unionid'])){
                    $unionid = $oauth_info['unionid'];
                }
                //处理用户数据
                $data = [
                    'openid'    =>  $oauth_info['openid'],
                    'unionid'   =>  $unionid,
                    'oauth_type' =>  'weixin_h5',
                    'shopid'    =>  $this->shopid,
                    'nickname'  =>  rand_nickname(config('system.USER_NICKNAME_PREFIX')),
                    'avatar' => !empty($oauth_info['avatar']) ? $oauth_info['avatar'] : '',
                    'sex' => !empty($oauth_info['sex']) ? $oauth_info['sex'] : 0,
                ];
                $user = $MemberModel->oauth($this->shopid, $data);
                $MemberModel->updateLogin($user['uid']);
                $uid = $user->uid;
            }
            //登录+
            $res = $MemberModel->login($this->shopid, $uid);
            if ($res) {
                $token = JWTAuth::builder(['uid' => $uid]); //参数为用户认证的信息，请自行添加
                $token = 'Bearer ' . $token;
                $last_url = session('login_http_referer');
                if (empty($last_url)) {
                    $last_url = request()->domain();
                }
                return $this->success('Login Successful', $token, $last_url);
            }
        }
    }

    /**
     * 是否扫码
     */
    public function hasScan()
    {
        if (request()->isAjax()) {
            $scene_key = input('get.scene_key', '');
            $data = (new QrcodeLogin())->getDataByMap([
                ['scene_key', '=', $scene_key]
            ]);
            if (!empty($data)) {
                $data = json_decode($data['metadata'], true);
                return $this->success('success', $data);
            }
            return $this->error('No relevant data found');
        }
    }

    /**
     * 网页授权
     */
    public function oauth()
    {
        $target_url = input('param.target_url', request()->domain());
        $target_url = explode('#', $target_url);
        $oauth_data = [
            'target_url' => urlencode($target_url[0])
        ];
        //uniapp hash路由带有# ,防止跳转授权时丢失
        if (isset($target_url[1])) {
            $oauth_data['spa_param'] = urlencode($target_url[1]);
        }
        $url = OfficialAccount::oauth($oauth_data);
        return redirect($url);
    }

    /**
     * 网页授权回调
     */
    public function oauthCallback()
    {
        $code = request()->param('code');
        $app = OfficialAccount::getApp();
        // 获取 OAuth 授权结果用户信息
        $user = $app->oauth->userFromCode($code);
        $user = $user->getRaw();
        try {
            //处理用户数据
            $MemberModel = new Member();
            $user['oauth_type'] = 'weixin_h5';
            $user['shopid'] = $this->shopid;
            $user['avatar'] = $user['headimgurl'];
            $user = $MemberModel->oauth($this->shopid, $user);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
        $MemberModel->updateLogin($user['uid']);
        //生成token
        $token = JWTAuth::builder(['uid' => $user['uid']]);
        $token = 'Bearer ' . $token;
        //跳回原网页
        $target_url = input('param.target_url');
        $spa_param = input('param.spa_param');

        $script = "window.location.href='{$target_url}#{$spa_param}'";
        echo save_local_storage('user_token', $token, $script);
        exit();
    }

    /**
     * 生成微信SDK
     * @return \think\Response|void
     */
    public function jssdk()
    {
        if (request()->isPost()) {
            $app = OfficialAccount::getApp();
            $apis = input('post.apis');
            $url = input('post.url');
            if (empty($apis)) {
                $apis = [
                    'chooseWXPay',
                    'checkJsApi',
                    'scanQRCode',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage'
                ];
            }
            $app->jssdk->setUrl($url);
            $jssdk = $app->jssdk->buildConfig($apis);
            return $this->success('success', json_decode($jssdk, true));
        }
    }
}
