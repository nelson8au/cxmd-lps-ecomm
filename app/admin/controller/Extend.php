<?php
namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\facade\Cache;
use app\admin\builder\AdminConfigBuilder;
use app\admin\model\ExtendConfig as MuuExtendConfigModel;

/**
 * 后台配置控制器
 */
class Extend extends Admin
{
    protected $moduleModel;
    protected $extendConfigModel;

    /**
     * 构造方法
     * @access public
     */
    public function __construct()
    {
        parent::__construct();

        $this->extendConfigModel = new MuuExtendConfigModel();
    }

    /**
     * 短信发送参数配置
     */
    public function sms() {

        if (request()->isPost()) {
            $config = input('post.');
            //dump($config);exit;
            if ($config && is_array($config)) {
                foreach ($config as $name => $value) {
                    $map = ['name' => $name];
                    Db::name('ExtendConfig')->where($map)->save(['value' => $value]);
                }
            }
            // 清理缓存
            Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');

            return $this->success('Save Successful',$config, 'refresh');

        }else{

            $list = Db::name("ExtendConfig")->where(['status' => 1])->field('id,name,title,extra,value,group,remark,type')->order('sort asc')->select()->toArray();
            $list = $this->extendConfigModel->lists();
//            dump($list);die();
            $builder = new AdminConfigBuilder();
            $builder->title('SMS Configuration')->suggest('Configure various parameters for sending SMS based on third-party platforms');
    
            // 基础配置
            $opt = ['aliyun' => 'Alibaba Cloud', 'tencent' => 'Tencent Cloud'];
            $builder->keySelect('SMS_SEND_DRIVER', 'Select Platform', 'Please select the third-party platform for sending SMS' , $opt);
            $builder->keyInteger('SMS_RESEND', 'Code Validity', 'Unit: seconds');
            $builder->group('Basic Configuration', ['SMS_SEND_DRIVER', 'SMS_RESEND']);
            
            // 阿里云短信参数配置
            $builder
                ->keyText('SMS_ALIYUN_ACCESSKEYID', 'AccessKeyID', 'Access Key ID is your key to access Alibaba Cloud API, which has full permissions of the account. Please keep it safe.')
                ->keyText('SMS_ALIYUN_ACCESSKEYSECRET', 'AccessKeySecret', 'Access Key Secret is your key to access Alibaba Cloud API, which has full permissions of the account. Please keep it safe.')
                ->keyText('SMS_ALIYUN_REGION', 'Region', 'Region information, format like: cn-beijing.')
                ->keyText('SMS_ALIYUN_SIGN', 'SMS Signature', 'SMS Signature, should be strictly filled in according to the "Signature Name". Please refer to: https://dysms.console.aliyun.com/dysms.htm#/develop/sign.')
                ->keyText('SMS_ALIYUN_TEMPLATEID', 'SMS Template', 'SMS Template Code, should be strictly filled in according to the "Template CODE". Please refer to: https://dysms.console.aliyun.com/dysms.htm#/develop/template.')
                ->group('Alibaba Cloud SMS', [
                    'SMS_ALIYUN_ACCESSKEYID', 
                    'SMS_ALIYUN_ACCESSKEYSECRET',
                    'SMS_ALIYUN_REGION',
                    'SMS_ALIYUN_SIGN',
                    'SMS_ALIYUN_TEMPLATEID'
                ]);

            // 腾讯云短信参数配置
            $builder
                ->keyText('SMS_TENCENT_SECRETID', 'SecretID', 'SecretID is the security key of your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('SMS_TENCENT_SECRETKEY', 'SecretKEY', 'SecretKEY is the security key of your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('SMS_TENCENT_REGION', 'Region', 'Region information, format like: ap-beijing.')
                ->keyText('SMS_TENCENT_APPID', 'AppID', 'SDK AppID is the unique identifier of the SMS application. This parameter is required when calling the SMS API interface.')
                //->keyText('SMS_TENCENT_APPKEY', 'App KEY', 'App Key是用来校验短信发送合法性的密码，与SDK AppID对应，需要业务方高度保密，切勿把密码存储在客户端.')
                ->keyText('SMS_TENCENT_SIGN', 'SMS Signature', 'Please use a real and applied signature. The signature parameter uses `signature content`, not `signature ID`.')
                ->keyText('SMS_TENCENT_TEMPLATEID', 'SMS Template', 'SMS Template ID, should be strictly filled in according to the "Template ID".')
                ->group('Tencent Cloud SMS', [
                    'SMS_TENCENT_SECRETID',
                    'SMS_TENCENT_SECRETKEY',
                    'SMS_TENCENT_REGION',
                    'SMS_TENCENT_APPID', 
                    //'SMS_TENCENT_APPKEY',
                    'SMS_TENCENT_SIGN',
                    'SMS_TENCENT_TEMPLATEID'
                ]);

            $builder->data($list);
            $builder->buttonSubmit();
            $builder->display();
        }

    }

    /**
     * 支付参数配置
     */
    public function payment() {

        if (request()->isPost()) {
            $config = input('post.');
            //dump($config);exit;
            if ($config && is_array($config)) {
                foreach ($config as $name => $value) {
                    $map = ['name' => $name];
                    Db::name('ExtendConfig')->where($map)->save(['value' => $value]);
                }
            }
            // 清理缓存
            Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');

            return $this->success('Save Successful',$config, 'refresh');

        }else{
            $list = $this->extendConfigModel->lists();
            $builder = new AdminConfigBuilder();
            $builder->title('Payment Configuration')->suggest('Configure various parameters for third-party payment platforms.');
            // 微信支付参数配置
            $builder
                ->keyText('WX_PAY_MCH_ID', 'MchID', 'Mch ID is your WeChat merchant ID. Please keep it safe.')
                ->keyText('WX_PAY_KEY_SECRET', 'KeySecret', 'Key Secret is your WeChat merchant API key. Please keep it safe.')
                ->keyText('WX_PAY_CERT_SERIAL', 'API Certificate Serial Number', 'Merchant API certificate serial number.')
                ->keySingleFile('WX_PAY_CERT', 'Cert Certificate','Cert Certificate Upload', ['enforce' => 'local'])
                ->keySingleFile('WX_PAY_KEY', 'Key Certificate','Key Certificate Upload', ['enforce' => 'local'])
                ->keyRadio('WX_PAY_WITHDRAW_API', 'Withdrawal Method API','Please select the withdrawal method API you applied for.', ['v2' => 'Enterprise Payment to Change', 'v3' => 'Merchant Transfer to Change'])
                ->keyText('WX_PAY_WITHDRAW_PLATFORM_SERIAL', 'Payment Platform Certificate Serial Number', 'Required when using the Merchant Transfer to Change API.')
                ->group('WeChat Pay', [
                    'WX_PAY_MCH_ID',
                    'WX_PAY_KEY_SECRET',
                    'WX_PAY_CERT_SERIAL',
                    'WX_PAY_CERT',
                    'WX_PAY_KEY',
                    'WX_PAY_WITHDRAW_API',
                    'WX_PAY_WITHDRAW_PLATFORM_SERIAL'
                ]);

            // 支付宝支付参数配置

            // 提现参数配置
            $opt = [0 => 'Close' ,1 => 'Open'];
            $builder
                ->keySelect('WITHDRAW_STATUS', 'Withdrawal Switch', 'Temporarily close withdrawals if needed',$opt)
                ->keyText('WITHDRAW_TAX_RATE', 'Withdrawal Fee', 'Default is 0.5% (unit: permillage)')
                ->keyText('WITHDRAW_DAY_NUM', 'Daily Withdrawal Limit', 'Maximum number of withdrawals per day')
                ->keyText('WITHDRAW_MIN_PRICE', 'Minimum Single Withdrawal Amount', 'Minimum amount for a single withdrawal')
                ->keyText('WITHDRAW_MAX_PRICE', 'Maximum Single Withdrawal Amount', 'Maximum amount for a single withdrawal')
                ->group('Withdrawal Configuration', [
                    'WITHDRAW_STATUS',
                    'WITHDRAW_TAX_RATE',
                    'WITHDRAW_DAY_NUM',
                    'WITHDRAW_MIN_PRICE',
                    'WITHDRAW_MAX_PRICE',
                ]);

            $builder->data($list);
            $builder->buttonSubmit();
            $builder->display();
        }
        
    }

    /**
     * 存储配置
     */
    public function store()
    {
        if (request()->isPost()) {
            $config = input('post.');
            //dump($config);exit;
            if ($config && is_array($config)) {
                foreach ($config as $name => $value) {
                    $map = ['name' => $name];
                    Db::name('ExtendConfig')->where($map)->save(['value' => $value]);
                }
            }
            // 清理缓存
            Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');
    
            return $this->success('Save Successful',$config, 'refresh');

        }else{

            $list = Db::name("ExtendConfig")->where(['status' => 1])->field('id,name,title,extra,value,group,remark,type')->order('sort asc')->select()->toArray();
            $list = $this->extendConfigModel->lists();
            $builder = new AdminConfigBuilder();
            $builder->title('Storage Configuration')->suggest('Configure various parameters for third-party cloud storage');
            
            // 基础配置
            $opt = ['local' => 'Local','aliyun' => 'Alibaba Cloud', 'tencent' => 'Tencent Cloud'];
            $builder
                ->keySelect('PICTURE_UPLOAD_DRIVER', 'Picture', 'Picture Upload Driver', $opt)
                ->keySelect('FILE_UPLOAD_DRIVER', 'File', 'File Upload Driver', $opt)
                ->group('Basic Configuration', [
                    'PICTURE_UPLOAD_DRIVER', 
                    'FILE_UPLOAD_DRIVER'
                ]);
            
            // 阿里云OSS参数配置
            $builder
                ->keyText('OSS_ALIYUN_ACCESSKEYID', 'AccessKeyID', 'Access Key ID is your key to access Alibaba Cloud API, which has full permissions of the account. Please keep it safe.')
                ->keyText('OSS_ALIYUN_ACCESSKEYSECRET', 'AccessKeySecret', 'Access Key Secret is your key to access Alibaba Cloud API, which has full permissions of the account. Please keep it safe.')
                ->keyText('OSS_ALIYUN_ENDPOINT', 'Endpoint', 'e.g., oss-cn-beijing.aliyuncs.com.')
                ->keyText('OSS_ALIYUN_BUCKET', 'Bucket', 'Bucket.')
                ->keyText('OSS_ALIYUN_BUCKET_DOMAIN', 'Bucket Domain', 'Bucket Domain.')
                ->group('Alibaba Cloud OSS', [
                    'OSS_ALIYUN_ACCESSKEYID', 
                    'OSS_ALIYUN_ACCESSKEYSECRET',
                    'OSS_ALIYUN_ENDPOINT',
                    'OSS_ALIYUN_BUCKET',
                    'OSS_ALIYUN_BUCKET_DOMAIN'
                ]);

            // 腾讯云COS参数配置
            $builder
                //->keyText('COS_TENCENT_APPID', 'APPID', 'APPID 是您项目的唯一ID.')
                ->keyText('COS_TENCENT_SECRETID', 'SecretID', 'SecretID is the security key of your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('COS_TENCENT_SECRETKEY', 'SecretKEY', 'SecretKEY is the security key of your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('COS_TENCENT_BUCKET', 'Bucket', 'Bucket Name.')
                ->keyText('COS_TENCENT_REGION', 'Region', 'Region where the bucket is located, format like: ap-beijing.')
                ->keyText('COS_TENCENT_BUCKET_DOMAIN', 'Bucket Domain', 'Tencent Cloud supports user-defined access domain. Note: The URL should start with http:// or https:// and should not end with "/". e.g., http://abc.com.')
                ->group('Tencent Cloud COS', [
                    //'COS_TENCENT_APPID', 
                    'COS_TENCENT_SECRETID',
                    'COS_TENCENT_SECRETKEY',
                    'COS_TENCENT_BUCKET',
                    'COS_TENCENT_REGION',
                    'COS_TENCENT_BUCKET_DOMAIN'
                ]);

            $builder->data($list);
            $builder->buttonSubmit();
            $builder->display();
        }
    }

    /**
     * 云点播配置管理
     */
    public function vod()
    {
        if (request()->isPost()) {
            $config = input('post.');
            
            if ($config && is_array($config)) {
                foreach ($config as $name => $value) {
                    $map = ['name' => $name];
                    Db::name('ExtendConfig')->where($map)->save(['value' => $value]);
                }
            }
            // 清理缓存
            Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');
    
            return $this->success('Save Successful',$config, 'refresh');

        }else{

            $list = Db::name("ExtendConfig")->where(['status' => 1])->field('id,name,title,extra,value,group,remark,type')->order('sort asc')->select()->toArray();
            $list = $this->extendConfigModel->lists();

            $builder = new AdminConfigBuilder();
            $builder->title('Audio and Video On-Demand Configuration')->suggest('Configure various parameters for third-party audio and video on-demand services.');
            
            // 基础配置
            $opt = ['disable' => 'Disable', 'tencent' => 'Tencent Cloud'];
            $builder
                ->keySelect('VOD_UPLOAD_DRIVER', 'Audio and Video On-Demand', 'Audio and video on-demand upload driver', $opt)
                ->group('Basic Configuration', [
                    'VOD_UPLOAD_DRIVER'
                ]);

            // 腾讯云VOD参数配置
            $builder
                ->keyText('VOD_TENCENT_SECRETID', 'SecretID', 'SecretID is the security key for your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('VOD_TENCENT_SECRETKEY', 'SecretKEY', 'SecretKEY is the security key for your project, which has full permissions of the account. Please keep it safe.')
                ->keyText('VOD_TENCENT_SUBAPPID', 'SubAppId', 'SubAppId is your cloud on-demand platform sub-application ID. Please keep it safe.')
                ->keyRadio('VOD_TENCENT_PROCEDURE', 'Preset Transcoding Encryption Task Flow', 'When enabled, it will trigger the system preset adaptive streaming encryption task SimpleAesEncryptPreset.', [0 => 'Disable', 1 => 'Enable'])
                ->keyRadio('VOD_TENCENT_KEY_SWITCH', 'Key Chain Switch', 'Key Chain Switch', [0 => 'Disable', 1 => 'Enable'])
                ->keyText('VOD_TENCENT_KEY_VALUE', 'Key Chain Value', 'Must be composed of uppercase and lowercase letters (a-Z) or numbers (0-9), and be between 8-20 characters long.')
                ->keyText('VOD_TENCENT_PLAYER_KEY', 'Player Key', 'Playback key in the default distribution configuration of the distribution playback settings. Only effective after the KEY anti-leech is enabled.')
                ->group('Tencent Cloud VOD', [
                    'VOD_TENCENT_SECRETID',
                    'VOD_TENCENT_SECRETKEY',
                    'VOD_TENCENT_SUBAPPID',
                    'VOD_TENCENT_PROCEDURE',
                    'VOD_TENCENT_KEY_SWITCH',
                    'VOD_TENCENT_KEY_VALUE',
                    'VOD_TENCENT_PLAYER_KEY'
                ]);

            $builder->data($list);
            $builder->buttonSubmit();
            $builder->display();
        }
    }

    /**
     * 扩展配置管理
     */
    public function list()
    {
        $group = input('group', 0);
        /* 查询条件初始化 */
        $map = [];
        $map[] = ['status','=', 1]; 
        if (isset($_GET['group'])) {
            $map[] = ['group','=',$group];
        }
        if (isset($_GET['name'])) {
            $map[] = ['name','like', '%' . (string)input('name') . '%'];
        }

        list($list,$page) = $this->commonLists('ExtendConfig', $map, 'sort,id');
        $list = $list->toArray()['data'];
        
        View::assign('group', config('extend.GROUP_LIST'));
        View::assign('group_id', input('get.group', 0));
        View::assign('list', $list);
        View::assign('page', $page);

        $this->setTitle('Configuration Management');

        return View::fetch();
    }

    /**
     * 编辑系统配置
     */
    public function edit($id = 0)
    {
        if (request()->isPost()) {
            $data = input('');
            //验证器
            $validate = $this->validate(
                [
                    'name'  => $data['name'],
                    'title'   => $data['title'],
                ],[
                    'name'  => 'require|max:32',
                    'title'   => 'require',
                ],[
                    'name.require' => 'Name is required',
                    'name.max'     => 'Name cannot exceed 32 characters',
                    'title.require'   => 'Title is required', 
                ]
            );
            if(true !== $validate){
                // 验证失败 输出错误信息
                return $this->error($validate);
            }

            $data['status'] = 1;//默认状态为启用
            $res = $resId = $this->extendConfigModel->edit($data);
            if($res){
                Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');
                //记录行为
                action_log('update_config', 'extend_config', $resId, is_login());

                return $this->success('Success','',url('list')->build());
            }else{
                return $this->error('Failed');
            }
            
        } else {
            /* 获取数据 */
            if($id != 0){
                $info = $this->extendConfigModel->getDataById($id);
            }else{
                $info = [];
            }

            View::assign('type', get_config_type_list());
            View::assign('group', config('extend.GROUP_LIST'));
            View::assign('info', $info);
            $this->setTitle('Edit Extended Configuration');

            return View::fetch();
        }
    }

    /**
     * 删除配置
     */
    public function del()
    {
        $id = array_unique((array)input('id', 0));

        if (empty($id)) {
            $this->error('Parameter Error');
        }

        if (Db::name('ExtendConfig')->where('id','in', $id)->delete()) {
            Cache::delete(request()->host() . '_MUUCMF_EXT_CONFIG_DATA');
            //记录行为
            action_log('update_config', 'extend_config', $id, is_login());
            return $this->success('Deleted Successfully');
        } else {
            return $this->error('Deletion Failed');
        }
    }

}