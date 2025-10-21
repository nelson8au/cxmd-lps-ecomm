<?php
namespace app\channel\controller\api;

use app\common\controller\Api;
use app\common\model\Member;
use app\common\model\MemberSync;
use thans\jwt\facade\JWTAuth;
use app\channel\facade\wechat\MiniProgram as MiniProgramServer;
use app\channel\model\Tominiprogram as TominiprogramModel;
use app\channel\logic\Tominiprogram as TominiprogramLogic;

/**
 * 微信小程序服务类
 * Class MiniProgram
 * @package app\channel\controller\service
 */
class WechatMiniProgram extends Api
{
    protected $MemberSyncModel;
    protected $MemberModel;
    protected $middleware = [
        'app\\common\\middleware\\CheckAuth' => ['only'=>['bindMobile']],
    ];
    function __construct()
    {
        parent::__construct();
        //初始化用户平台标识模型
        $this->MemberSyncModel = new MemberSync();
        //初始化用户模型
        $this->MemberModel = new Member();
    }
    
    /**
     * code 换取用户信息
     * @param $code
     */
    public function code($code)
    {
        $result = MiniProgramServer::user($code);
        if (!isset($result['openid'])){
            return $this->error($result['errmsg']);
        }
        //查询是否注册过
        $map = [];
        $map[] = ['openid','=',$result['openid']];
        $map[] = ['type','=', 'weixin_mp'];
        $user = $this->MemberSyncModel->getDataByMap($map);
        if (!empty($user)){
            $user = query_user($user['uid'],['uid','nickname','avatar','email','mobile','realname','sex','score']);
            if(is_array($user)){
                $this->MemberModel->updateLogin($user['uid']);
                $token = JWTAuth::builder(['uid'=>$user['uid']]);
                $token = 'Bearer ' . $token;
                $res = [
                    'token'     => $token
                ];
                return $this->success('success',$res);
            }else{
                return $this->error('error','User has been disabled or deleted');
            }
        }else{
            return $this->error('error','No user information found');
        }
    }

    /**
     * 小程序授权登录
     */
    public function login()
    {
        $params = input('param.');
        $oauth = MiniProgramServer::user($params['code']);
        if (!isset($oauth['openid'])){
            return $this->error($oauth['errmsg']);
        }
        //查询是否注册过
        $map[] = ['openid','=',$oauth['openid']];
        $map[] = ['type','=', 'weixin_mp'];
        $user = $this->MemberSyncModel->getDataByMap($map);
        // 已登录过
        if (!empty($user)){
            $user = query_user($user['uid'],['uid','nickname','avatar','email','mobile','realname','sex','score']);
            $this->MemberModel->updateLogin($user['uid']);
        }else{
            // 未登录过，创建用户
            $result = MiniProgramServer::decryptData($oauth['session_key'],$params['iv'],$params['encrypted_data']);
            $nickname = $result['nickName'];
            if($nickname == 'WeChat User'){
                $nickname = rand_nickname(config('system.USER_NICKNAME_PREFIX'));
            }
            $data = [
                'unionid'   => $oauth['unionid'] ?? '',
                'openid'    => $oauth['openid'],
                'nickname'  => $nickname,
                'avatar'    => $result['avatarUrl'],
                'sex'       => $result['gender'],
                'shopid'    => $params['shopid'],
                'oauth_type' => 'weixin_mp'
            ];
            $user = $this->MemberModel->oauth($this->shopid, $data);
        }

        if ($user){
            $this->MemberModel->updateLogin($user['uid']);
            $token = JWTAuth::builder(['uid'=>$user['uid']]);
            $token = 'Bearer ' . $token;
            return $this->success('success',['token'=>$token]);
        }

        return $this->error('Login Required','login');
    }

    /**
     * 获取小程序码：适用于需要的码数量极多，或仅临时使用的业务场景
     * @return mixed
     */
    public function unlimitQrcode()
    {
        //小程序路径
        $path = input('param.path');
        //二维码url参数
        $scene = input('param.scene','');
        $width = input('param.width','500');
        $option = [
            'page' => $path,
            'width' => $width
        ];
        $result = MiniProgramServer::unlimitQrcode($scene, $option);
        Header("Content-type: image/jpeg");//直接输出显示jpg格式图片
        echo $result;
    }

    /**
     * 绑定手机号
     */
    public function bindMobile()
    {
        $uid = request()->uid;
        $code = input('code');
        $iv = input('iv');
        $encrypted = input('encrypted');
        $code_decode = MiniProgramServer::user($code);
        $session_key = $code_decode['session_key'];
        $data = MiniProgramServer::decryptData($session_key,$iv,$encrypted);
        //保存手机号
        $res = $this->MemberModel->edit([
            'uid' => $uid,
            'mobile' => $data['phoneNumber']
        ]);

        if ($res){
            return $this->success('Phone number bound successfully');
        }
        return $this->error('Failed to bind phone number');
    }

    /**
     * 跳转小程序列表
     */
    public function toMiniProgramLists()
    {
        $TominiprogramModel = new TominiprogramModel();
        $TominiprogramLogic = new TominiprogramLogic();
        $rows = input('rows', 10, 'intval');
        $map = [
            ['shopid', '=', $this->shopid],
            ['type', '=', 'weixin_app']
        ];
        // 获取列表
        $lists = $TominiprogramModel->getListByPage($map, 'id DESC', '*', $rows);
        $lists = $lists->toArray();
        foreach ($lists['data'] as &$val) {
            $val = $TominiprogramLogic->formatData($val);
        }
        unset($val);

        return $this->success('SUCCESS', $lists);
    }

    /**
     * 跳转小程序数据详情
     */
    public function toMiniProgramDetail()
    {
        $id = input('id', 0, 'intval');
        if(!empty($id)){
            $TominiprogramModel = new TominiprogramModel();
            $TominiprogramLogic = new TominiprogramLogic();
            $data = $TominiprogramModel->getDataById($id);
            $data = $TominiprogramLogic->formatData($data);

            return $this->success('SUCCESS', $data);
        }

        return $this->error('Parameter Error');
    }

}