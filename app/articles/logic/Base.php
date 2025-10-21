<?php
namespace app\articles\logic;

class Base
{

    public $_status = [
        1  => 'Enable',
        0  => 'Disable',
        -1 => 'Deleted',
        -2 => 'Review Not Approved'
    ];

    /**
     * 生成封面缩微图
     */
    public function setCoverAttr($data, $proportion = '4:3')
    {
        if($proportion == '1:1'){
            $width = 100;
            $height = 100;
        }
        if($proportion == '4:3'){
            $width = 100;
            $height = 75;
        }
        if($proportion == '16:9'){
            $width = 100;
            $height = 56;
        }
        if($proportion == '3:5'){
            $width = 100;
            $height = 167;
        }
        if(empty($data['cover'])){
            $data['cover'] = $data['cover_100'] = $data['cover_200'] = $data['cover_300'] = $data['cover_400'] = $data['cover_800'] = request()->domain() . '/static/common/images/nopic.png';
        }else{
            //处理缩微图
            $data['cover_100'] = get_thumb_image($data['cover'], intval($width), intval($height));
            $data['cover_200'] = get_thumb_image($data['cover'], intval($width*2), intval($height*2));
            $data['cover_300'] = get_thumb_image($data['cover'], intval($width*3), intval($height*3));
            $data['cover_400'] = get_thumb_image($data['cover'], intval($width*4), intval($height*4));
            $data['cover_800'] = get_thumb_image($data['cover'], intval($width*8), intval($height*8));
        }
        return $data;
    }
    public function setTitleAttr($data)
    {
        if(empty($data['title'])){
            $data['title'] = '标题为空';
        }

        return $data;
    }

    public function setStatusAttr($data,$attrArray = [])
    {
        if(empty($attrArray)){
            $attrArray = $this->_status;
        }
        $data['status_str'] = $attrArray[$data['status']];

        return $data;
    }
    public function setTimeAttr($data)
    {
        if(!empty($data['create_time'])){
            $data['create_time_str'] = time_format($data['create_time']);
            $data['create_time_friendly_str'] = friendly_date($data['create_time']);
        }
        if(!empty($data['update_time'])){
            $data['update_time_str'] = time_format($data['update_time']);
            $data['update_time_friendly_str'] = friendly_date($data['update_time']);
        }
        if(!empty($data['start_time'])){
            $data['start_time_str'] = time_format($data['start_time']);
        }
        if(!empty($data['end_time'])){
            $data['end_time_str'] = time_format($data['end_time']);
        }
        if(!empty($data['use_time'])){
            $data['use_time_str'] = time_format($data['use_time']);
        }
        if(!empty($data['paid_time'])){
            $data['paid_time_str'] = time_format($data['paid_time']);
        }
        if(!empty($data['logistic_time'])){
            $data['logistic_time_str'] = time_format($data['logistic_time']);
        }
        if(!empty($data['reply_time'])){
            $data['reply_time_str'] = time_format($data['reply_time']);
        }


        return $data;
    }
}