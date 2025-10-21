<?php
namespace app\common\logic;

class Keywords extends Base
{

    public $_status  = [
        1  => 'Enable',
        0  => 'Disable',
        -1 => 'Delete',
    ];
    public $_recommend = [
        0 => '未推荐',
        1 => '推荐'
    ];

    /**
     * 处理数据
     */
    public function formatData($data)
    {

        $data['recommend_str'] = $this->_recommend[$data['recommend']];
        $data['status_str'] = $this->_status[$data['status']];
        
        $data = $this->setTimeAttr($data);
        if(!empty($data['uid'])){
            $data['user_info'] = query_user($data['uid']);
        }

        return $data;
    }
}