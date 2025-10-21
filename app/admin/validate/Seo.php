<?php
namespace app\admin\validate;

use think\Validate;

class Seo extends Validate
{
    protected $rule = [
        'title'  =>  'require',
    ];
    
    protected $message = [
        'title'  =>  'Rule title is required',
    ];
    
}