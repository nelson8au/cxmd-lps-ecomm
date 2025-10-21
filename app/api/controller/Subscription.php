<?php

namespace app\api\controller;

use app\common\controller\Api;
use GuzzleHttp\Psr7\Request as Psr7Request;
use think\Request;
use think\facade\Log;

class Subscription extends Api
{
  function __construct(Request $request)
  {
    parent::__construct();
  }

  public function updateStatus()
  {
    try {
      $crmUserId = $this->params['crmUserId'];
      $subscriptionStatus = $this->params['subscriptionStatus'];

      $client = new \GuzzleHttp\Client();

      $headers = [
        'x-api-key' => env('lps.x_api_key'),
        'Content-Type' => 'application/json'
      ];

      if($subscriptionStatus) {
        $body = '{
          "usr_id": "' . $crmUserId . '",
          "lp2fee_status": true
        }';
      } else {
        $body = '{
          "usr_id": "' . $crmUserId . '",
          "lp2fee_status": false
        }';
      }
      Log::info('Send request to /prod/lp2fee_subscription: ' . $body);

      $request = new Psr7Request('POST', env('lps.root_url') . '/prod/lp2fee_subscription', $headers, $body);
      $res = $client->sendAsync($request)->wait();

      $clientData = json_decode($res->getBody()->getContents(), true);
      Log::info('Receive request from /prod/lp2fee_subscription: ' . json_encode($clientData));

      return $this->result(200, 'Request Successful', $clientData);
    } catch (\Exception $e) {
      Log::info('Backend Request Failed:' . $e->getMessage());
      return $this->result(400, 'Backend Request Failed：' . $e->getMessage());
    }
  }
}
