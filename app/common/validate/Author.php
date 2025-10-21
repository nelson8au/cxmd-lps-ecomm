<?php
namespace app\common\validate;
 
use think\Validate;
 
/**
 * 创作者验证器
 */
class Author extends Validate
{
    protected $rule = [
        'name'  =>  'require',
        'description'  =>  'require',
        'professional'  =>  'require',
        'group_id' => 'require|gt:0',
        'content'  =>  'require',
    ];
    
    protected $message  =   [
        'name.require' =>  'Real name cannot be empty',
        'description.require' => 'Short description cannot be empty',
        'professional.require' => 'Job title cannot be empty',
        'group_id.require' => 'Author Type is not selected',
        'group_id.gt' => 'Author Type is not selected',
        'content.require' => 'Content cannot be empty',

    ];
    
    protected $scene = [
        'edit'   =>  ['name','description','professional','group_id','content'],
    ];
}
