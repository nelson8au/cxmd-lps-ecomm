<?php

namespace app\api\controller;

use app\common\validate\Address as AddressValidate;
use think\exception\ValidateException;
use app\common\controller\Api;
use app\common\model\Address as AddressModel;
use app\common\logic\Address as AddressLogic;
use think\facade\Db;

class Address extends Api
{
  protected $model;
  protected $logic;
  // protected $middleware = [
  //   'app\\common\\middleware\\CheckAuth',
  // ];
  function __construct()
  {
    parent::__construct();
    $this->model = new AddressModel();
    $this->logic = new AddressLogic();

    header('Access-Control-Allow-Origin: ' . config('app.fontend_url'));
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
  }

  /**
   * 获取默认地址
   */
  public function default()
  {
    $uid = request()->uid;
    $map = [
      ['uid', '=', $uid],
      ['shopid', '=', $this->shopid],
      ['first', '=', 1],
      ['status', '=', 1],
    ];
    $data = $this->model->getDataByMap($map);
    if (!$data) {
      $map = [
        ['uid', '=', $uid],
        ['status', '=', 1],
        ['shopid', '=', $this->shopid],
      ];
      $data = $this->model->getDataByMap($map);
    }
    $data = $this->logic->formatData($data);
    return $this->success('Retrieved Successful！', $data);
  }

  public function detail()
  {
    $id = input('get.id', 0);
    $data = $this->model->getDataById($id);
    $data = $this->logic->formatData($data);
    return $this->success('Retrieved Successful！', $data);
  }

  public function lists()
  {
    $uid = request()->get('uid') === null ? get_uid() : request()->get('uid');
    //初始化查询条件
    $map = [
      ['shopid', '=', $this->shopid],
      ['uid', '=', $uid],
      ['status', '=', 1]
    ];
    $lists = $this->model->getList($map, 99);
    foreach ($lists as &$item) {
      $item = $this->logic->formatData($item);
    }
    unset($item);
    return $this->result(200, 'Retrieved Successful！', $lists);
  }

  /**
   * 新增/编辑地址
   */
  public function edit()
  {
    if (request()->isPost()) {
      $param = request()->post();
      $uid = request()->uid ?? $param['uid'];
      $data = [
        'id' => $param['id'],
        'shopid' => $this->shopid,
        'uid' => $uid,
        'name' => $param['name'],
        'phone_prefix' => $param['phone_prefix'],
        'phone' => $param['phone'],
        'pos_country' => $param['pos_country'],
        'pos_province' => $param['pos_province'],
        'postcode' => $param['postcode'],
        'address' => $param['address'],
        'first' => isset($param['first']) && $param['first'] === 'on', //默认地址
        'status' => 1
      ];

      // 数据验证
      try {
        validate(AddressValidate::class)->check($data);
      } catch (ValidateException $e) {
        // 验证失败 输出错误信息
        return $this->result(400, $e->getError());
      }

      //写入数据
      $res = $this->model->edit($data);
      if ($res) {
        //关闭其他默认地址
        if ($data['first'] == 1) {
          $id = is_object($res) ? $res->id : $res;
          $this->model->where([
            ['id', '<>', $id],
            ['shopid', '=', $this->shopid],
            ['uid', '=', $uid]
          ])->update([
            'update_time' => time(),
            'first' => 0
          ]);
        }
        //返回提示
        return $this->result(200, 'Edit Success！', $res);
      } else {
        return $this->result(400, 'Edit Failed！');
      }
    }
  }

  /**
   * 设为默认地址
   */
  public function setDefault()
  {
    $uid = request()->uid;
    $id  = input('get.id');
    $this->model->where([
      ['uid', '=', $uid],
      ['shopid', '=', $this->shopid]
    ])->update([
      'update_time' => time(),
      'first' => 0
    ]);
    $res = $this->model->where([
      ['id', '=', $id],
      ['shopid', '=', $this->shopid]
    ])->update([
      'update_time' => time(),
      'first' => 1
    ]);
    if ($res) {
      return $this->success('Settings Saved！', $res, 'refresh');
    } else {
      return $this->error('Settings Failed！');
    }
  }

  public function del($id)
  {
    $res = $this->model->edit([
      'id' => $id,
      'status' => -1
    ]);
    if ($res) {
      return $this->success('Deleted Successfully！');
    } else {
      return $this->error('Deletion Failed！');
    }
  }

  public function districts()
  {
    $districts = Db::table('muucmf_district')->select();

    $nestedStructure = $this->buildNestedStructure($districts);

    return $this->result(200, 'Retrieved Successful', $nestedStructure);
  }

  function buildNestedStructure($data, $parentId = 0, $level = 1)
  {
    $result = [];

    foreach ($data as $item) {
      if ($item['upid'] == $parentId) {
        $child = $this->buildNestedStructure($data, $item['id'], $level + 1);

        if (!empty($child)) {
          $item['child'] = $child;
        }

        $result[] = $item;
      }
    }

    return $result;
  }
}
