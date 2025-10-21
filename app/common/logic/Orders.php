<?php
namespace app\common\logic;

/*
 * MuuCmf
 * 订单数据逻辑层
 */

use app\channel\logic\Channel;

class Orders extends Base
{
    public $shipper = [
        'SF'=>'SF Express',
        'HTKY'=>'Best Express',
        'ZTO'=>'ZTO Express',
        'STO'=>'STO Express',
        'YTO'=>'YTO Express',
        'YD'=>'Yunda Express',
        'YZPY'=>'China Post Express Parcel',
        'EMS'=>'EMS',
        'HHTT'=>'Tian Tian Express',
        'JD'=>'JD Express'
    ];

    /**
     * 订单通用状态
     * @var string[]
     */
    public $_status = [
        1 => 'Pending Payment',
        2 => 'Pending Shipment', 
        3 => 'Pending Receipt', 
        4 => 'Pending Review', //确认收货
        5 => 'Completed', //已完成评价
        0 => 'Cancelled',
        -1 => 'Deleted'
    ];

    /**
     * 支付状态
     * @var string[]
     */
    protected $_paid = [
        0 => 'Unpaid',
        1 => 'Paid'
    ];

    /**
     * 退款状态
     * @var string[]
     */
    public $_refund = [
        -1 => 'Refund Rejected',
        0 => 'No Refund Requested',
        1 => 'Refund Requested',
        2 => 'Returning',
        3 => 'Returned',
        4 => 'Refund Completed',
        //5 => '已完成',
    ];

    /**
     * 支付渠道
     * @var [type]
     */
    public $_pay_channel = [
        'weixin' => 'WeChat',
        'alipay' => 'Alipay',
        'douyin' => 'Douyin',
        'baidu'  => 'Baidu',
        'offline' => 'Offline Payment',
        'score' => 'Score',
        'convert' => 'Redeem Code',
        '' => 'None'
    ];

    /**
     * 格式化数据
     */
    public function formatData($data)
    {
        $order_namespace = "app\\{$data['app']}\\logic\\Orders";
        $appOrdersLogic = new $order_namespace;
        
        $data = $appOrdersLogic->formatData($data);
        
        return $data;
    }

    /**
     * 导出数据格式化
     */
    public function exportParse($list, $header = array()){
        if (empty($list)) {
            return '';
        }
        
        $keys = array_keys($header);
        $html = "\xEF\xBB\xBF";
        foreach ($header as $li) {
            $html .= $li . "\t ,";
        }
        $html .= "\n";
        $count = count($list);
        $pagesize = ceil($count/5000);
        for ($j = 1; $j <= $pagesize; $j++) {
            $list = array_slice($list, ($j-1) * 5000, 5000);
            
            if (!empty($list)) {
                $size = ceil(count($list) / 500);
                for ($i = 0; $i < $size; $i++) {
                    $buffer = array_slice($list, $i * 500, 500);
                    
                    $column_data = array();
                    foreach ($buffer as &$row) {
                        if($row)
                        if($row['paid'] == 1){
                            $row['paid_time'] = date('Y-m-d H:i:s', $row['paid_time']);
                        }
                        $row['paid'] = $this->_paid[$row['paid']];
                        $row['paid_fee'] = '￥' . sprintf("%.2f",$row['paid_fee']/100);
                        $row['create_time'] = date('Y-m-d H:i:s', $row['create_time']);
                        $row['products'] = json_decode($row['products'],true);
                        $row['products_title'] = $row['products']['title'];
                        foreach ($keys as $key) {
                            $data[] = $row[$key];
                        }
                        $column_data[] = implode("\t ,", $data) . "\t ,";
                        unset($data);
                    }
                    unset($row);
                    $html .= implode("\n", $column_data) . "\n";
                }
            }
        }
        return $html;
    }
}