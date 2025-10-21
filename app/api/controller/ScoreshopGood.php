<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\logic\Orders as OrdersLogic;
use app\common\model\Brand;
use app\common\model\Member;
use \app\common\model\Orders as OrdersModel;
use app\scoreshop\model\ScoreshopGoods;
use think\Exception;
use think\exception\ValidateException;
use think\facade\Db;
use app\common\validate\Orders as OrdersValidate;
use app\scoreshop\model\ScoreshopCategory;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use think\Request;
use think\facade\Log;
use think\Response;

class ScoreshopGood extends Api
{
  private $OrdersModel; //订单模型
  private $OrdersLogic; //订单逻辑
  function __construct(Request $request)
  {
    parent::__construct();
    $this->OrdersLogic = new OrdersLogic();
    $this->OrdersModel = new OrdersModel();
  }

  public function index($sortBy = 'id', $key = 'desc', $option = null, $area = null, $brandId = null, $categoryId = null, $pagePerItem = 12, $lang = 'en')
  {
    $titleField = $lang === 'en' ? 'title' : 'title_' . $lang;
    $descriptionField = $lang === 'en' ? 'description' : 'description_' . $lang;
    // Building the where condition
    $whereCondition = null;
    if (isset($option)) {
      switch ($option) {
        case 'latest':
          $whereCondition = ['is_latest' => 1];
          break;
        case 'hottest':
          $whereCondition = ['is_hottest' => 1];
          break;
        case 'special_discount':
          $whereCondition = ['is_special_discount' => 1];
          break;
      }
    }

    if (isset($categoryId)) {
      $whereCondition['category_id'] =  $categoryId;
    }

    if (isset($brandId)) {
      $whereCondition['brand_id'] = $brandId;
    }

    if (isset($area) && ($area === 'women_area' || $area === 'men_area')) {
      $whereCondition[$area === 'women_area' ? 'is_women_area' : 'is_men_area'] = 1;
    }

    // Check for Dragon Boat Festival category
    $dragonBoatFestivalCategory = ScoreshopCategory::where('title', '端午乐购')->where('status', 1)->find();

    // Start building the query
    $scoreshopGoods = ScoreshopGoods::where('status', '1');

    // Apply where conditions if any
    if (!is_null($whereCondition)) {
      $scoreshopGoods = $scoreshopGoods->where($whereCondition);
    }

    // Exclude Dragon Boat Festival category if applicable
    if (isset($dragonBoatFestivalCategory->id)) {
      $scoreshopGoods = $scoreshopGoods->where('category_id', '<>', $dragonBoatFestivalCategory->id);
    }

    // Select the necessary fields
    $scoreshopGoods = $scoreshopGoods->field('id,' . $titleField . ' as title_lang, title, ' . $descriptionField . ' as description_lang, description, cover, price, marking_price, sku')
      ->order($sortBy, $key)
      ->paginate($pagePerItem);

    // Modify each item in the collection
    $scoreshopGoods->each(function ($record) {
      $record['title'] = !empty($record['title_lang']) ? $record['title_lang'] : $record['title'];
      $record['description'] = !empty($record['description_lang']) ? $record['description_lang'] : $record['description'];
      unset($record['title_lang']);
      unset($record['description_lang']);
      return $record;
    });

    // Return the results
    return $this->result(200, 'Successfully retrieved item', $scoreshopGoods);
  }

  public function search($sortBy = 'id', $key = 'desc', $pagePerItem = 12, $lang = 'en')
  {
    // Determine the appropriate fields based on the language
    $titleField = $lang === 'en' ? 'title' : 'title_' . $lang;
    $descriptionField = $lang === 'en' ? 'description' : 'description_' . $lang;

    // Get the search query from input
    $query = input('keywords');

    // Assume the search method returns a list of IDs matching the query
    $scoreshopGoodsModel = new ScoreshopGoods();
    $results = $scoreshopGoodsModel->search($query);

    // Prepare the IDs for the whereIn query
    $implodedIds = implode(',', $results['ids']);
    $scoreshopGoodsQuery = ScoreshopGoods::whereIn('id', $implodedIds)
      ->where('status', '1')
      ->field('id, ' . $titleField . ' as title_lang, title, ' . $descriptionField . ' as description_lang, description, cover, price, marking_price, sku')
      ->order($sortBy, $key);

    // Paginate the results
    $scoreshopGoods = $scoreshopGoodsQuery->paginate($pagePerItem);

    // Modify each item in the collection
    $scoreshopGoods->each(function ($record) {
      $record['title'] = !empty($record['title_lang']) ? $record['title_lang'] : $record['title'];
      $record['description'] = !empty($record['description_lang']) ? $record['description_lang'] : $record['description'];
      unset($record['title_lang']);
      unset($record['description_lang']);
      return $record;
    });

    // Return the results
    return $this->result(200, 'Successfully retrieved item', $scoreshopGoods);
  }

  public function show($id, $lang = 'en')
  {
    // Determine the fields based on the language
    $titleField = $lang === 'en' ? 'title' : 'title_' . $lang;
    $descriptionField = $lang === 'en' ? 'description' : 'description_' . $lang;

    // Fetch the record with the necessary fields
    $scoreshopGood = ScoreshopGoods::field("id, $titleField as title_lang, title, $descriptionField as description_lang, description, cover, price, marking_price, sku, category_id, images, sku_translations")
      ->find($id)
      ->append(['category_name']); // Assuming category_name is an accessor or a related model field

    // Apply the transformations
    if ($scoreshopGood) {
      $scoreshopGood['title'] = !empty($scoreshopGood['title_lang']) ? $scoreshopGood['title_lang'] : $scoreshopGood['title'];
      $scoreshopGood['description'] = !empty($scoreshopGood['description_lang']) ? $scoreshopGood['description_lang'] : $scoreshopGood['description'];
      unset($scoreshopGood['title_lang']);
      unset($scoreshopGood['description_lang']);

      $skuTranslations = json_decode($scoreshopGood['sku_translations'], true);
      $filteredTranslations = [];

      if (isset($skuTranslations)) {
        foreach ($skuTranslations as $key => $value) {
          // Check if the key ends with the specified language suffix
          if (preg_match("/_(en|$lang)$/", $key)) {
            $baseKey = str_replace(["_$lang", "_en"], '', $key); // Get the base key (e.g., color, purple, etc.)

            // Only take the translation for $lang if it exists; otherwise, use 'en' as a fallback
            if (isset($skuTranslations["{$baseKey}_$lang"]) && !empty($skuTranslations["{$baseKey}_$lang"])) {
              $filteredTranslations[$baseKey] = $skuTranslations["{$baseKey}_$lang"];
            } elseif (isset($skuTranslations["{$baseKey}_en"])) {
              $filteredTranslations[$baseKey] = $skuTranslations["{$baseKey}_en"];
            }
          }
        }
      }

      // Replace sku_translations with filtered translations
      $scoreshopGood['sku_translations'] = $filteredTranslations;
    }

    // Return the result
    return $this->result(200, 'Successfully retrieved item', $scoreshopGood);
  }

  public function categories($lang = 'en')
  {
    $titleField = $lang === 'en' ? 'title' : 'title_' . $lang;
    $categories = ScoreshopCategory::where('status', 1)
      ->field('id, ' . $titleField . ' as title_lang, title, cover')
      ->select()
      ->map(function ($category) {
        $category['title'] = !empty($category['title_lang']) ? $category['title_lang'] : $category['title'];
        unset($category['title_lang']);
        return $category;
      });

    return $this->result(200, 'Successfully retrieved category', $categories);
  }

  public function brands($lang = 'en')
  {
    $brands = Brand::where('status', 1)
      ->field('id, name_' . $lang . ' as name_lang, name_en, image, slug, status')
      ->select()
      ->map(function ($brand) {
        $brand['name'] = !empty($brand['name_lang']) ? $brand['name_lang'] : $brand['name_en'];
        unset($brand['name_lang'], $brand['name_en']);
        return $brand;
      });

    return $this->result(200, 'Successfully retrieved brand', $brands);
  }

  public function orderCreate()
  {
    if (request()->isPost()) {
      Db::startTrans();
      try {
        if (isset($this->params) && count($this->params) > 0) {
          // TODO: Condition checking for Dragon boat festival
          // $category = ScoreshopCategory::where('title', '端午乐购')->where('status', 1)->find();

          // if (isset($category)) {
          //   $orderInfoIdToCheck = $category->id;
          //   $count = 0;
          //   $containsOrderInfoId = false;

          //   $uid = get_uid();

          //   $orders = OrdersModel::where('uid', $uid)
          //     ->group('order_info_id') // Group by order_info_id
          //     ->field('MAX(id) as id, order_info_id') // Aggregate the id column using MAX
          //     ->select();

          //   if (isset($orders) && count($orders) !== 0) {
          //     foreach ($orders as $order) {
          //       $good = ScoreshopGoods::find($order['order_info_id']);
          //       if ($good->category_id === $orderInfoIdToCheck) {
          //         $containsOrderInfoId = true;
          //         break; // No need to continue once we find a match
          //       }
          //     }
          //   } else {
          //     foreach ($this->params as $param) {
          //       $good = ScoreshopGoods::find($param['order_info_id']);
          //       if ($good->category_id === $orderInfoIdToCheck) {
          //         $count += $param['quantity'];
          //         if ($count > 1) {
          //           break; // No need to continue once we know there is more than one
          //         }
          //       }
          //     }
          //   }

          //   if ($count > 1 || $containsOrderInfoId) {
          //     return $this->result(400, 'Does not meet redemption conditions');
          //   }
          // }

          $orders = [];

          foreach ($this->params as $param) {
            $param['uid'] = get_uid();

            try {
              validate(OrdersValidate::class)->check($param);
            } catch (ValidateException $e) {
              return $this->result(400, $e->getError());
            }

            $order_data = $param;

            if (isset($param['formId'])) {
              $order_data['form_id'] = $param['formId'];
            }

            $user = Member::where('uid', $param['uid'])->find();
            if (!$user) {
              return $this->result(404, 'User not found');
            }

            if (!$param['crmUserId']) {
              Log::info('CRM User ID Error:' . $param['crmUserId']);
              return $this->result(400, 'Login status abnormal, please log in again');
            }

            try {
              $client = new \GuzzleHttp\Client();
              $headers = [
                'x-api-key' => env('lps.x_api_key'),
                'Content-Type' => 'application/json'
              ];

              $scoreshopGood = ScoreshopGoods::find($param['goods_id']);
              if (!$scoreshopGood) {
                return $this->result(404, 'Item not found');
              }

              $category = ScoreshopCategory::find($scoreshopGood->category_id);

              $lpAmt = $scoreshopGood->price * $param['quantity'];
              $nextIncrementOrderId = date('Ymd') . time() . $scoreshopGood->id;

              $body = '{
                "usr_id": "' . $param['crmUserId'] . '",
                "spent_type": "lp2shop",
                "order_id": "' . $nextIncrementOrderId . '",
                "lp_amt": ' . $lpAmt . ',
                "product_name": "' . $scoreshopGood->title . '",
                "category_name": "' . $category->title . '"
              }';
              Log::info('Send request to ' . env('lps.wallet_route') . ': ' . $body);

              $request = new Psr7Request('POST', env('lps.root_url') . env('lps.wallet_route'), $headers, $body);
              $res = $client->sendAsync($request)->wait();

              $clientData = json_decode($res->getBody()->getContents(), true);
              Log::info('Receive request from ' . env('lps.wallet_route') . ': ' . json_encode($clientData));

              if (isset($clientData['message']) && $clientData['message'] === 'successful') {
                $modifiedData = [
                  "id" => $scoreshopGood->id,
                  "title" => $scoreshopGood->title,
                  "description" => $scoreshopGood->description,
                  "type" => $param['order_info_type'],
                  "type_str" => $param['order_info_type'],
                  "express" => 1,
                  "price" => $scoreshopGood->price,
                  "cover" => $scoreshopGood->cover,
                  "quantity" => $param['quantity'],
                  "sku" => $param['sku'],
                  "link" => [
                    "url" => "goods/detail",
                    "param" => [
                      "id" => $scoreshopGood->id,
                    ],
                  ],
                ];

                $order_data['order_no'] = $nextIncrementOrderId;
                $order_data['pay_channel'] = 'score';
                $order_data['paid_fee'] = $scoreshopGood->price * $param['quantity'];
                $order_data['price'] = $scoreshopGood->price;
                $order_data['products'] = json_encode($modifiedData);
                $order_data['create_time'] = time();
                $order_data['update_time'] = time();
                $order_data['address_id'] = $param['address_id'];
                $order_data['paid_time'] = time();
                $order_data['paid'] = 1;
                $order_data['status'] = 2;

                $recordId = Db::table('muucmf_orders')->strict(false)->insertGetId($order_data);

                if (!$recordId) {
                  throw new Exception('Order creation failed, please try again later');
                }

                $order = $this->OrdersModel->getDataById($recordId);
                $order = $this->OrdersLogic->formatData($order);

                array_push($orders, $order);
              } else {
                Log::info($param['crmUserId'] . ':' . $clientData['message']);
                return $this->result(400, $clientData['message']);
              }
            } catch (\Exception $e) {
              Log::info($param['crmUserId'] . ':' . $e->getMessage());
              return $this->result(400, 'Request Failed：' . $e->getMessage());
            }
          }

          Db::commit();

          return $this->result(200, 'Order created successfully', $orders);
        } else {
          return $this->result(400, 'Invalid format');
        }
      } catch (Exception $e) {
        Db::rollback();
        if (\think\facade\App::isDebug()) {
          Log::info($e->getMessage() . $e->getFile() . $e->getLine());
          return $this->error($e->getMessage() . $e->getFile() . $e->getLine());
        } else {
          Log::info($e->getMessage());
          return $this->error($e->getMessage());
        }
      }
    }
  }

  public function cashRedemption($point, $amount, $crmUserId)
  {
    $uid = get_uid();
    $user = Member::where('uid', $uid)->find();
    if (!$user) {
      return $this->result(404, 'Cannot find this user');
    }

    // if (!$crmUserId || !$lpsWalletAccountNumber || !$serverId || $crmUserId === 'null' || $lpsWalletAccountNumber === 'null' || $serverId === 'null') {
    //   Log::info('Points account number or CRM user ID is incorrect:' . $lpsWalletAccountNumber . ',' . $crmUserId . ',' . $serverId);
    //   return $this->result(400, 'Login status abnormal, please log in again');
    // }

    if (!$crmUserId) {
      Log::info('Points account number or CRM user ID is incorrect:' . $crmUserId);
      return $this->result(400, 'Login status abnormal, please log in again');
    }

    $lpsWalletAccountNumber = $this->getLpsWalletNumbers($crmUserId);

    if(!$lpsWalletAccountNumber) {
      return $this->result(404, 'Invalid wallet.');
    }

    try {
      $client = new \GuzzleHttp\Client();

      $headers = [
        'x-api-key' => env('lps.x_api_key'),
        'Content-Type' => 'application/json'
      ];

      $body = '{
          "usr_id": "' . $crmUserId . '",
          "spent_type": "lp2cash",
          "lp_amt": ' . $point . ',
          "us_amt": ' . $amount . '
      }';
      Log::info('Send request to ' . env('lps.wallet_route') . ': ' . $body);

      $request = new Psr7Request('POST', env('lps.root_url') . env('lps.wallet_route'), $headers, $body);
      $res = $client->sendAsync($request)->wait();

      $clientData = json_decode($res->getBody()->getContents(), true);
      Log::info('Receive request from ' . env('lps.wallet_route') . ': ' . json_encode($clientData));

      if (isset($clientData['message']) && $clientData['message'] === 'successful') {
        try {
          $client = new \GuzzleHttp\Client();
          $headers = [
            'Authorization' => 'Bearer ' . env('crm.api_key'),
            'Content-Type' => 'application/json',
          ];

          $token = env('crm.token');

          $body = json_encode([
            // "fromSid" => "3",
            // "fromLogin" => "163238",
            // "toSid" => $serverId,
            // "toLogin" => $lpsWalletAccountNumber,
            // "status" => "approved",
            // "amount" => $amount,
            // "comment" => "LP to Trade Credit",
            // "type" => "internal transfer",

            "lpsWalletId" => $lpsWalletAccountNumber,
            "amount" => $amount,
            "comment" => "LP to Trade Credit",
            'token' => $token,
          ]);

          $comment = 'LP to Trade Credit';
          $expiration = Carbon::now();

          Log::info('Sending request to /api.lps.user.wallet.walletBalanceCorrection: ' . $body);
          $res = $client->request('POST', env('crm.root_url') . "/api.lps.user.wallet.walletBalanceCorrection?lpsWalletId=$lpsWalletAccountNumber&amount=$amount&comment=$comment&token=$token", ['headers' => $headers, 'body' => $body, 'exceptions' => false]);

          if ($res->getStatusCode() !== 200) {
            $this->result(400, 'Backend request error');
          }

          $decodedRes = json_decode($res->getBody()->getContents());
          Log::info('Receive request from /api.lps.user.wallet.walletBalanceCorrection: ' . json_encode($decodedRes));

          if ($res->getStatusCode() === 200) {
            Log::info('Loyalty Points Successfully Redeemed: ' . $crmUserId);
            return $this->result(200, 'Loyalty Points Successfully Redeemed', $decodedRes);
          } else {
            Log::info('Redemption failed: ' . $crmUserId);
            return $this->result(400, 'Loyalty Points Redeem failed');
          }
        } catch (\Exception $e) {
          Log::info('Backend error: ' . $e->getMessage());
          return $this->result(400, 'Backend error');
        }
      } else {
        Log::info($clientData['message']);
        return $this->result(400, $clientData['message']);
      }
    } catch (\Exception $e) {
      Log::info('Backend Request Failed:' . $e->getMessage());
      return $this->result(400, 'Backend Request Failed：' . $e->getMessage());
    }
  }

  public function getLpsWalletNumbers($crmUserId)
  {
    $client = new \GuzzleHttp\Client();
    $headers = [
      'Authorization' => 'Bearer ' . env('crm.api_key'),
      'Content-Type' => 'application/json'
    ];
    $body = '{"userId": "' . $crmUserId . '"}';
    $token = env('crm.token');

    Log::info('Send request from /api.lps.user.wallet.getWallets: ' . json_encode($body));
    $request = new Psr7Request('POST', env('crm.root_url') . "/api.lps.user.wallet.getWallets?userId=$crmUserId&token=$token", $headers, $body);
    $res = $client->sendAsync($request)->wait();

    $decodedRes = json_decode($res->getBody()->getContents());
    Log::info('Receive request from /api.lps.user.wallet.getWallets: ' . json_encode($decodedRes));

    return $decodedRes[0]->id ?? null;

    // return $this->result(200, 'Retrieved Successful', $decodedRes);
  }

  public function exportCsv()
  {
    $fromDate = input('post.from_date');
    $toDate = input('post.to_date');

    $startDate = strtotime($fromDate . ' 00:00:00');
    $endDate = strtotime($toDate . ' 23:59:59');

    $data = OrdersModel::where('create_time', '>=', $startDate)
      ->where('create_time', '<=', $endDate)
      ->select();

    $csvFilePath = 'report_' . $fromDate . '_' . $toDate . '.csv';

    // Open the CSV file for writing
    $csvFile = fopen($csvFilePath, 'w');

    // Write the header row
    fputcsv($csvFile, [
      'ID',
      'UserID',
      'Username',
      'Order No.',
      'Status（1:Paid，0:Unpaid）',
      'Product',
      'Amount',
      'Order Status',
      'Recipient Name',
      'Recipient Phone',
      'Detail Address',
      'Country',
      'Province',
      'Postal Code',
    ]);

    // Write each user's data to the CSV file
    foreach ($data as $row) {
      switch ($row['status']) {
        case 2:
          $status = 'Pending Shipment';
          break;
        case 3:
          $status = 'Pending Receipt';
          break;
        case 4:
          $status = 'Pending Review';
          break;
        case 5:
          $status = 'Completed';
          break;
        default:
          $status = 'Pending Payment';
      }

      $product = json_decode($row->products);
      $address = Db::table('muucmf_address')->find($row->address_id);
      $user = Db::table('muucmf_member')->where('uid', $row->uid)->find();

      $phoneNumber = isset($address['phone_prefix']) && isset($address['phone']) ? $address['phone_prefix'] . $address['phone'] : '';

      fputcsv($csvFile, [
        $row->id,
        $user['crm_user_id'],
        $user['username'],
        $row->order_no,
        $row->paid,
        $product->title,
        $row->paid_fee,
        $status,
        $address['name'] ?? '',
        $phoneNumber,
        $address['address'] ?? '',
        $address['pos_country'] ?? '',
        $address['pos_province'] ?? '',
        $address['postcode'] ?? '',
      ]);
    }

    // Close the CSV file
    fclose($csvFile);

    // Return CSV content as a response object
    return Response::create($csvFilePath, 'file', 200);
  }

  public function editCategoryTranslation()
  {
    if (request()->isPost()) {
      $param = request()->post();
      $categoryId = $param['category_id'];

      $titleAR = $param['title_ar'];
      $titleHI = $param['title_hi'];
      $titleID = $param['title_id'];
      $titleJA = $param['title_ja'];
      $titleTH = $param['title_th'];
      $titleVI = $param['title_vi'];
      $titleMS = $param['title_ms'];
      $titleZH = $param['title_zh'];
      $titlePT = $param['title_pt'];
      $titleES = $param['title_es'];

      $record = Db::table('muucmf_scoreshop_category')->find($categoryId);

      if (!$record) {
        return $this->result(404, 'Record not found');
      }

      Db::table('muucmf_scoreshop_category')->where('id', $categoryId)->update([
        'title_ar' => $titleAR,
        'title_hi' => $titleHI,
        'title_id' => $titleID,
        'title_ja' => $titleJA,
        'title_th' => $titleTH,
        'title_vi' => $titleVI,
        'title_ms' => $titleMS,
        'title_zh' => $titleZH,
        'title_pt' => $titlePT,
        'title_es' => $titleES,
      ]);

      return $this->result(200, 'Saved Successful');
    }
  }
}
