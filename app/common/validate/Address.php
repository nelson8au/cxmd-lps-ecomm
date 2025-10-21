<?php
namespace app\common\validate;
 
use think\Validate;
 
/**
 * 验证器
 */
class Address extends Validate
{
    protected $rule = [
        'name'  =>  'require|egt:1',
        'uid' => 'require|egt:1',
        'phone_prefix'  =>  'require',
        'phone'  =>  'require',
        'pos_province'  =>  'require',
        'pos_country'  =>  'require',
        'postcode'  =>  'require',
        'address'  =>  'require',
    ];
    
    protected $message  =   [
        'name.require' =>  'Full name is required',
        'name.egt' =>  'Full name is required',
        'uid.require' => 'UID is required',
        'uid.egt' => 'UID is required',
        'phone_prefix.egt' => 'Phone prefix is required',
        'phone.require' => 'Phone number is required',
        'pos_province.require' => 'Province is required',
        'pos_country.require' => 'Country is required',
        'postcode.require' => 'Postcode is required',
        'address.require' => 'Address is required',
    ];
    
    protected $scene = [
        'edit'   =>  ['uid','name', 'phone_prefix','phone','pos_province','pos_country','postcode','address'],
    ];
}
