<?php
namespace app\common\logic;

use app\common\model\AuthorGroup;
/*
 * 作者数据逻辑层
 */
class Author extends Base
{

    public $_status = [
		0 => 'Disable',
		1 => 'Enabled',
		-1 => 'Not Reviewed',
	    -2 => 'Review Not Approved',
        -3 => 'Deleted',
	];

    /**
     * 条件查询
     * @param  string $keyword       [description]
     * @param  string $status        状态：all:所有 （不包括已删除）1：已上架 0：已下架 -1：Not Reviewed -2：Review Not Approved -3：已删除
     * @return array                [description]
     */
    public function getMap($shopid, $keyword = '', $status = 'all')
    {
        //初始化查询条件
        $map = [];
        
        if(!empty($shopid)){
            $map[] = ['shopid', '=', $shopid];
        }
        
        if($status == 'all'){
            $map[] = ['status', '>=', -2];
        }elseif($status == 0){
            $map[] = ['status', '>=', $status];
        }else{
            $map[] = ['status', '=', $status];
        }

        if(!empty($keyword)){
            $map[] = ['name', 'like', '%'. $keyword .'%'];
        }
        
        return $map;
    }

    /**
     * 格式化数据
     */
    public function formatData($data)
    {
        if(!empty($data)){
            $data = $this->setCoverAttr($data, '1:1');
            $data['content'] = htmlspecialchars_decode($data['content']);
            
            // 绑定用户的创造者获取用户数据
            if(!empty($data['uid'])){
                $data['user_info'] = query_user($data['uid']);
            }

            if(!empty($data['groud_id'])){
                $data['groud'] = (new AuthorGroup())->where('id', $data['groud_id'])->value('title');
            }else{
                $data['groud'] = '';
            }

            // 状态描述
            $data['status_str'] = $this->_status[$data['status']];
            // 时间处理
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
        }
        
        
        return $data;
    }

}