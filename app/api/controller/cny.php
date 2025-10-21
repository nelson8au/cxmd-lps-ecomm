<?php

namespace app\api\controller;

use app\common\controller\Api;
use GuzzleHttp\Psr7\Request;
use think\facade\Log;

class Cny extends Api
{
  function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    if (request()->isPost()) {
      $account = input('post.email', '', 'text');
      $password = input('post.password', '', 'text');

      $client = new \GuzzleHttp\Client();
      $headers = [
        'Authorization' => 'Bearer ' . env('crm.api_key'),
      ];

      $body = json_encode([
        'email' => $account,
        'password' => $password
      ]);

      Log::info('Send request to /user/check_credentials: ' . $body);

      $res = $client->request('POST', env('crm.root_url') . '/user/check_credentials', ['headers' => $headers, 'body' => $body, 'exceptions' => false,]);

      if ($res->getStatusCode() !== 200) {
        $this->result(404, '登录失败');
      }

      $decodedRes = json_decode($res->getBody()->getContents());

      Log::info('Receive request from /user/check_credentials: ' . json_encode($decodedRes));

      return $this->result(200, 'Login Successful', $decodedRes);
    }
  }

  public function valid()
  {
    if (request()->isPost()) {
      $userId = input('post.userId', '', 'text');
      $begin = input('post.begin', '', 'text');
      $end = input('post.end', '', 'text');

      $client = new \GuzzleHttp\Client();
      $headers = [
        'Authorization' => 'Bearer ' . env('crm.api_key'),
      ];

      $body = json_encode([
        'userId' => $userId,
        'createdAt' => [
          'begin' => $begin,
          'end' => $end,
        ]
      ]);

      Log::info('Send request to /trades: ' . $body);

      $res = $client->request('POST', env('crm.root_url') . '/trades', ['headers' => $headers, 'body' => $body, 'exceptions' => false,]);

      if ($res->getStatusCode() !== 200) {
        $this->result(404, '获取失败');
      }

      $decodedRes = json_decode($res->getBody()->getContents());

      Log::info('Receive request from /trades: ' . json_encode($decodedRes));

      return $this->result(200, 'Retrieved Successful', $decodedRes);
    }
  }

  public function redeem()
  {
    if (request()->isPost()) {
      $id = input('post.id', '', 'text');
      $login = input('post.login', '', 'text');
      $toSid = input('post.toSid', '', 'text');

      $client = new \GuzzleHttp\Client();

      $headers = [
        'x-api-key' => env('lps.x_api_key'),
        'Content-Type' => 'application/json'
      ];

      $body = json_encode([
        'id' => $id,
        'login' => $login,
        'toSid' => $toSid,
      ]);

      Log::info('Send request to /prod/main: ' . $body);

      $request = new Request('POST', env('lps.cny_root_url') . '/prod/main', $headers, $body);
      $res = $client->sendAsync($request)->wait();
      $decodedRes = json_decode($res->getBody()->getContents(), true);

      Log::info('Receive request from /prod/main: ' . json_encode($decodedRes));

      return $this->result(200, 'Retrieved Successful', $decodedRes);
    }
  }
}
