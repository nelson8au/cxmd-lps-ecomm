<?php

declare(strict_types=1);

namespace app\index\controller;

use think\facade\View;
use app\common\controller\Common;
use app\common\model\Search as SearchModel;
use app\common\model\Keywords as KeywordsModel;

class Search extends Common
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $uid = get_uid();
        $keyword = trim(input('keyword','','text'));
        View::assign('keyword',$keyword);

        // 初始化数据
        $lists = [];
        $pager = '';
        if(!empty($keyword)){
            // 记录搜索关键字
            $keyword_data = [
                'uid' => $uid,
                'shopid' => $this->shopid,
                'keyword' => $keyword,
                'status' => 1
            ];
            // 查询该用户是否查询过
            $has_keyword = (new KeywordsModel)->getDataByMap($keyword_data);
            if($has_keyword){
                $keyword_data['id'] = $has_keyword['id'];
            }
            // 写入数据
            (new KeywordsModel)->edit($keyword_data);
            
            // 查询数据
            // 排序方式
            $order_field = input('order_field', 'update_time', 'text');
            View::assign('order_field', $order_field);
            $order_type = input('order_type', 'DESC', 'text');
            View::assign('order_type', $order_type);
            $order = $order_field . ' ' . $order_type;
            // 显示数量
            $rows = input('rows',20, 'intval');
            // 查询条件
            $map = [
                ['shopid', '=', $this->shopid],
                ['content', 'like', '%' . $keyword . '%']
            ];
            $fields = '*';
            $lists = (new SearchModel)->getListByPage($map,$order,$fields, $rows);
            $pager = $lists->render();
            
            $lists = $lists->toArray();
            foreach ($lists['data'] as &$val) {
                $val = (new SearchModel)->handle($val);
                $val['content']['title'] = str_ireplace($keyword, '<strong>' .$keyword. '</strong>', $val['content']['title']);
                $val['content']['description'] = str_ireplace($keyword, '<strong>' .$keyword. '</strong>', $val['content']['description']);
                $val['url'] = url($val['app'] . '/' . $val['info_type'] . '/detail', ['id' => $val['info_id']]);
            }
            unset($val);
            
        }
        View::assign('lists',$lists);
        View::assign('pager',$pager);
        //dump($lists);
        $this->setTitle('Search');

        return View::fetch();
    }
}
