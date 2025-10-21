<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Member;
use app\common\model\Orders;
use app\scoreshop\model\ScoreshopCategory;
use app\scoreshop\model\ScoreshopGoods;
use Carbon\Carbon;

class DragonBoatFestival extends Api
{
  function __construct()
  {
    parent::__construct();
  }

  public function index($sortBy = 'id', $key = 'desc')
  {
    $dragonBoatFestivalCategory = ScoreshopCategory::where('title', '端午乐购')->find();

    $scoreshopGoods = ScoreshopGoods::where('status', '1');

    if (isset($dragonBoatFestivalCategory->id)) {
      $scoreshopGoods = $scoreshopGoods->where('category_id', $dragonBoatFestivalCategory->id);
    }

    $scoreshopGoods = $scoreshopGoods->order($sortBy, $key)->select();

    return $this->result(200, '获取物品成功', $scoreshopGoods);
  }


  public function checkValid()
  {
    $uid = get_uid();
    $currentDate = Carbon::now();

    $startDate = Carbon::create(null, 6, 6);
    $endDate = Carbon::create(null, 6, 12, 23, 59, 59);

    if ($currentDate->lt($startDate) || $currentDate->gt($endDate)) {
      return $this->result(400, '活动尚未开始，无法兑换！');
    }

    $user = Member::where('uid', $uid)->find();

    if (!$user) {
      return $this->result(404, '未找到此用户');
    }

    $orders = Orders::where('uid', $uid)
      ->group('order_info_id') // Group by order_info_id
      ->field('MAX(id) as id, order_info_id') // Aggregate the id column using MAX
      ->select();

    $category = ScoreshopCategory::where('title', '端午乐购')->find();

    $orderInfoIdToCheck = $category->id;
    $containsOrderInfoId = false;

    foreach ($orders as $order) {
      $good = ScoreshopGoods::find($order['order_info_id']);
      if ($good->category_id === $orderInfoIdToCheck) {
        $containsOrderInfoId = true;
        break; // No need to continue once we find a match
      }
    }

    if ($containsOrderInfoId) {
      return $this->result(400, '您已兑换过活动商品');
    }

    return $this->result(200, '资格通过');
  }
}
