<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Member;
use app\common\logic\Orders as OrdersLogic;
use app\common\model\Orders as OrdersModel;
use app\common\model\Address as AddressModel;

class User extends Api
{
  private $OrdersModel; //订单模型
  private $OrdersLogic; //订单逻辑
  protected $addressModel;

  function __construct()
  {
    parent::__construct();
    $this->OrdersLogic = new OrdersLogic();
    $this->OrdersModel = new OrdersModel();
    $this->addressModel = new AddressModel();
  }

  public function information()
  {
    $uid = get_uid();
    $user = Member::where('uid', $uid)->find();
    if (!$user) {
      return $this->result(404, 'Cannot find this user');
    }

    $user = query_user($user->uid, ['username', 'nickname', 'signature', 'email', 'mobile', 'avatar', 'sex', 'birthday']);

    return $this->result(200, 'Retrieved Successful！', $user);
  }

  public function setDefaultAddress($id)
  {
    $uid =  get_uid();

    $user = Member::where('uid', $uid)->find();
    if (!$user) {
      return $this->result(404, 'Cannot find this user');
    }

    $this->addressModel->where([
      ['uid', '=', $uid],
      ['shopid', '=', $this->shopid]
    ])->update([
      'update_time' => time(),
      'first' => 0
    ]);
    $res = $this->addressModel->where([
      ['id', '=', $id],
      ['shopid', '=', $this->shopid]
    ])->update([
      'update_time' => time(),
      'first' => 1
    ]);
    if ($res) {
      return $this->result(200, 'Settings Saved!', $res, 'refresh');
    } else {
      return $this->result(400, 'Settings Failed!');
    }
  }

  public function deleteAddress($id)
  {
    $uid =  get_uid();

    $user = Member::where('uid', $uid)->find();
    if (!$user) {
      return $this->result(404, 'Cannot find this user');
    }

    $res = $this->addressModel->edit([
      'id' => $id,
      'status' => -1
    ]);

    if ($res) {
      return $this->result(200, 'Deleted Saved!', $res, 'refresh');
    } else {
      return $this->result(400, 'Deleted Failed!');
    }
  }

  public function orders($status = 'all', $rows = 15)
  {
    $uid = get_uid();
    $user = Member::where('uid', $uid)->find();
    if (!$user) {
      return $this->result(404, 'Cannot find this user');
    }

    $map = [
      ['shopid', '=', $this->shopid],
      ['uid', '=', $uid],
    ];

    if ($status  == 'all') {
      $map[] = ['status', 'between', [0, 9]];
    } else {
      $map[] = ['status', '=', $status];
    }

    $order =  'id desc';
    $fields = '*';
    $lists = $this->OrdersModel->getListByPage($map, $order, $fields, $rows);
    $pager = $lists->render();
    $lists = $lists->toArray();
    foreach ($lists['data'] as &$val) {
      $val = $this->OrdersLogic->formatData($val);
    }
    unset($val);

    $data = ['lists' => $lists, 'pager' => $pager, 'status' => $status];
    // 输出模板
    return $this->result(200, 'Retrieved Successful!', $data);
  }
}
