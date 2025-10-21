<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 通用数据验证
 */
class Common extends Validate
{
    protected $rule = [
        'title'  =>  'require',
        'description' => 'require',
        'content' => 'require',
        'icon' => 'require',
        'type_id' => 'number|min:1|between:1,99999999999',
        'keyword'  =>  'require',
    ];
    
    protected $message = [
        'title'  =>  'Title cannot be empty',
        'description' => 'Short description cannot be empty',
        'content' => 'Content cannot be empty',
        'icon' => 'Icon not uploaded',
        'type_id' => 'Message type not selected',
        'keyword' => 'Keyword cannot be empty'
    ];

    protected $scene = [
        // 公告
        'announce'  =>  ['title', 'content'],
        // 消息类型
        'message_type'   =>  ['title', 'description', 'icon'],
        // 消息发送
        'message'   =>  ['type_id', 'title', 'description', 'content'],
        // 关键字
        'keywords'  =>  ['keyword'],
    ];    
    
}