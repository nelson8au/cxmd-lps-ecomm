<?php
namespace app\articles\validate;
 
use think\Validate;
 
/**
 * 表单验证器
 */
class Articles extends Validate
{
    protected $rule = [
        'title'  =>  'require',
        'description' =>  'require',
        'cover' => 'require',
        'category_id' => 'require'
    ];
    
    protected $message  =   [
        'title.require' =>  'Title cannot be empty',
        'description.require' => 'Short description cannot be empty',
        'cover.require' => '封面必须上传',
        'category_id' => 'Please Select'
    ];
    
    protected $scene = [
        'edit'   =>  ['title','description','cover','category_id'],
    ];
}
