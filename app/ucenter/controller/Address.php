<?php

namespace app\ucenter\controller;

use app\common\model\Address as AddressModel;
use think\facade\Db;
use think\facade\View;

/**
 * 订单页
 */
class Address extends Base
{
  protected $middleware = [
    'app\\common\\middleware\\CheckAuth',
  ];

  function __construct()
  {
    parent::__construct();
  }

  /**
   * @title 地址列表
   */
  public function lists()
  {
    $uid = is_login();
    $addresses = AddressModel::where('uid', $uid)->select();

    View::assign('tab', 'address');
    View::assign('addresses', $addresses);
    View::assign('appHost', config('app.app_host'));

    $this->setTitle('My Address');

    if (isset($this->params['from'])) {
      View::assign('logout', true);
    } else {
      View::assign('logout', false);
    }

    return View::fetch();
  }

  public function edit($id = null)
  {
    if (isset($id)) {
      $address = AddressModel::find($id);
      $country = Db::table('muucmf_district')->where('name', $address->pos_country)->where('level', 1)->find();
      $provinces = Db::table('muucmf_district')->where('upid', $country['id'])->where('level', 2)->select();

      View::assign('address', $address);
      View::assign('provinces', $provinces);
    }

    $countries = Db::table('muucmf_district')->where('level', 1)->select();

    $uid = is_login();
    View::assign('tab', 'address');
    View::assign('countries', $countries);
    View::assign('uid', $uid);
    View::assign('phonePrefixes', config('constant.phone_prefixes'));
    View::assign('appHost', config('app.app_host'));

    $this->setTitle('New Address');

    return View::fetch();
  }

  public function delete($id)
  {
    if (!isset($id)) {
      return $this->error('Deletion Failed');
    }

    $address = AddressModel::find($id);
    $address->delete();

    return $this->success('Deleted Successfully');
  }

  public function districts()
  {
    if (request()->isGet()) {
      $value = request()->get('value');
      $level = request()->get('level');

      $nextLevel = $level === '1' ? 2 : ($level === '2' ? 3 : 1);

      $province = Db::table('muucmf_district')->where('name', $value)->where('level', $level)->find();

      $records = Db::table('muucmf_district')->where('upid', $province['id'])->where('level', $nextLevel)->select();

      return $this->result(200, 'Retrieved Successful', $records);
    }
  }

  public function default($id, $uid)
  {
    if (!isset($id)) {
      return $this->result(400, 'Deletion Failed');
    }

    $addresses = AddressModel::where('uid', $uid)->select();

    foreach ($addresses as $address) {
      $address->first = 0;
      $address->save();
    }

    $defaultAddress = AddressModel::find($id);
    if ($defaultAddress) {
      $defaultAddress->first = 1;
      $defaultAddress->save();
    }

    return $this->result(200, 'Settings Saved');
  }
}
