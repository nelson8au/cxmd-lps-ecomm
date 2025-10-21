<?php
namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Feedback as FeedbackModel;

/**
 * 收藏接口
 * Class Favorites
 * @package app\minishop\controller
 */
class Feedback extends Api
{
    //添加token验证中间件
    protected $middleware = [
        'app\\common\\middleware\\CheckAuth',
    ];

    /**
     * 建议、反馈
     */
    public function add()
    {
        $uid = request()->uid;
        $content = input('post.content','');
        if (empty($content)){
            $this->error('Content cannot be empty');
        }
        if (input('?post.images')){
            $images = input('post.images');
            $images = explode(',', $images);
        }else{
            $images = '';
        }
        $data = [
            'shopid' => $this->shopid,
            'content' => $content,
            'images' => $images,
            'uid' => $uid,
        ];
        $res = (new FeedbackModel())->edit($data);
        if ($res){
            return $this->success('Submission Successful, we will process your feedback as soon as possible.');
        }
        return $this->error('Network error, please try again later');
    }

}