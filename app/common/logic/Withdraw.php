<?php
namespace app\common\logic;

use app\channel\logic\Channel;

/**
 * @title 提现逻辑类
 * Class Withdraw
 * @package app\common\logic
 */
class Withdraw extends Base
{
    public $_paid = [
        0 => 'Processing Withdrawal',
        1 => 'Finished'
    ];

    public $_error = [
        0 => 'Success',
        1 => "Failed"
    ];

    public function formatData($data)
    {
        //用户数据
        $data['price'] = sprintf("%.2f",floatval($data['price']/100));
        $data['real_price'] = sprintf("%.2f",floatval($data['real_price']/100));
        $data['paid_str'] = $this->_paid[$data['paid']];
        $data['error_str'] = $this->_error[$data['error']];
        if($data['paid_time'] == 0){
            $data['paid_time_str'] = 'Processing';
        }else{
            $data['paid_time_str'] = time_format($data['paid_time']);
        }
        $data['openid'] = get_openid($data['shopid'], $data['uid'],$data['channel']);
        $data['user_info'] = query_user($data['uid'],['nickname','avatar']);
        $data['channel_str'] = Channel::$_channel[$data['channel']];

        if(!empty($data['error_msg'])){
            $data['error_msg'] = json_decode($data['error_msg'], true);
        }
        $data = $this->setTimeAttr($data);
        return $data;
    }
}