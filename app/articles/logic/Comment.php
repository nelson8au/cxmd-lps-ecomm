<?php
namespace app\articles\logic;

use think\facade\Cache;
use app\articles\model\ArticlesConfig as ConfigModel;
use app\articles\logic\Config as ConfigLogic;
use app\articles\model\ArticlesArticles as ArticlesModel;
use app\articles\model\ArticlesComment as CommentModel;
use app\common\model\Support as SupportModel;

/*
 * 评论数据逻辑层
 */
class Comment extends Base
{
    protected $ConfigModel;
    protected $ConfigLogic;
    protected $CommentModel;
    protected $ArticlesModel;
    protected $SupportModel;

    public function __construct()
    {
        $this->ConfigModel = new ConfigModel();
        $this->ConfigLogic = new ConfigLogic();
        $this->CommentModel = new CommentModel();
        $this->ArticlesModel = new ArticlesModel();
        $this->SupportModel = new SupportModel();
    }

    /**
     * 内容状态
     */
	public $_status = [
        1  => 'Enable',
        0  => 'Disable',
        -1 => 'Not Reviewed',
        -2 => 'Review Not Approved',
        -3 => 'Deleted',
    ];

    /**
     * 条件查询
     * @param  string $keyword       [description]
     * @param  string $category_id   [description]
     * @param  string $attribute_ids [description]
     * @param  string $type          [description]
     * @param  string $status        状态：all:所有 （不包括Deleted）1：已上架 0：已下架 -1：Not Reviewed -2：Review Not Approved -3：Deleted
     * @return [type]                [description]
     */
    public function getMap($shopid, $keyword = '',$article_id = '', $status = 1)
    {
        //初始化查询条件
        $map = [];
        
        if(!empty($shopid)){
            $map[] = ['shopid', '=', $shopid];
        }
        
        if(is_numeric($status)){
            $map[] = ['status', '=', $status];
        }
        if(is_array($status)){
            $map[] = ['status', 'in', $status];
        }

        if(!empty($keyword)){
            $map[] = ['content', 'like', '%'. $keyword .'%'];
        }
        
        //文章id
        if(!empty($article_id)){
            $map[] = ['article_id', '=', $article_id];
        }

        return $map;
    }

    /**
     * 数据格式化
     */
    public function formatData($data = [])
    {
        // 获取店铺配置数据
        $shopid = intval($data['shopid']);

        if(!empty($data)){
            $id = $data['id'];
            $data['content'] = htmlspecialchars_decode($data['content']);
            $data['status_str'] = $this->_status[$data['status']];
            if(!empty($data['create_time'])){
                $data['create_time_str'] = time_format($data['create_time']);
                $data['create_time_friendly_str'] = friendly_date($data['create_time']);
            }
            if(!empty($data['update_time'])){
                $data['update_time_str'] = time_format($data['update_time']);
                $data['update_time_friendly_str'] = friendly_date($data['update_time']);
            }

            $data['article'] = $this->ArticlesModel->getDataById($data['article_id']);
            $data['user_info'] = query_user($data['uid']);
            //判断是否点赞
            if($this->SupportModel->yesSupport($shopid, 'articles', get_uid(), $data['id'], 'Comment')){
                $data['support_yesno'] = 1;
            }else{
                $data['support_yesno'] = 0;
            }
        }

        return $data;
    }

}