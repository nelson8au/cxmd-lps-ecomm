<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Member;
use GuzzleHttp\Psr7\Request;
use thans\jwt\facade\JWTAuth;
use think\facade\Log;

class Auth extends Api
{
  public function login()
  {
    if (request()->isPost()) {
      $account = input('post.email', '', 'text');
      $password = input('post.password', '', 'text');

      if (empty($account)) return $this->result(404, 'The email is required');

      if (empty($password)) return $this->result(404, 'The password is required');

      $commonMemberModel = new Member();

      $crmUserId = $this->loginWithCRM($account, $password);

      if (!isset($crmUserId) || $crmUserId === 0) {
        return $this->result(404, 'Invalid login');
      }

      // $userInfoFromCRM = $this->getUserFromCRM($crmUserId);
      // $isIb = $userInfoFromCRM->isIb;

      $user = $commonMemberModel->where(['email' => $account])->find();
      if (!$user) {
        // $username = $userInfoFromCRM->firstName . $userInfoFromCRM->lastName;
        $uid = $commonMemberModel->register($account, $account, $password, $account, '', 'email', $crmUserId);
      } else {
        $uid = $user->uid;
      }

      $res = $commonMemberModel->login($this->shopid, $uid, 0);

      if ($res) {
        $last_url = session('login_http_referer');
        if (empty($last_url)) {
          $last_url = request()->domain();
        }
        $token = JWTAuth::builder(['uid' => $uid]);
        $token = 'Bearer ' . $token;

        return $this->result(200, 'Login Successfully', ['token' => $token, 'crmUserId' => $crmUserId, 'isIb' => 'false'], $last_url);
      } else {
        return $this->result(401, 'Failed to login');
      }
    }
  }

  public function loginWithCRM($account, $password)
  {
    $client = new \GuzzleHttp\Client();
    $headers = [
      'Content-Type' => 'application/json',
      'Authorization' => 'Bearer ' . env('crm.api_key'),
    ];

    $encodedPassword = urlencode($password);

    $body = json_encode([
      'email' => $account,
      'password' => $encodedPassword,
    ]);

    $token = env('crm.token');

    try {
      Log::info('Send request to /api.lps.user.checkCredentials: ' . $body);
      $res = $client->request('POST', env('crm.root_url') . "/api.lps.user.checkCredentials?email=$account&password=$encodedPassword&token=$token", ['headers' => $headers, 'body' => $body, 'exceptions' => false,]);

      if ($res->getStatusCode() !== 200) {
        $this->result(404, 'Something wrong');
      }

      $decodedRes = json_decode($res->getBody()->getContents());
      Log::info('Receive request from /api.lps.user.checkCredentials: ' . json_encode($decodedRes));

      return $decodedRes->userId ?? 0;
    } catch (\Throwable $th) {
      Log::info('Catch error from /api.lps.user.checkCredentials: ' . $th);
      return 0;
    }
  }

  public function getUserFromCRM($id)
  {
    $client = new \GuzzleHttp\Client();
    $headers = [
      'Authorization' => 'Bearer ' . env('crm.api_key'),
    ];

    $res = $client->request('GET', env('crm.root_url') . '/users/' . $id, ['headers' => $headers, 'exceptions' => false,]);

    if ($res->getStatusCode() !== 200) {
      $this->result(404, 'Something wrong');
    }

    $decodedRes = json_decode($res->getBody()->getContents());

    return $decodedRes;
  }

  public function dashboard($crmUserId, $isIb)
  {
    $client = new \GuzzleHttp\Client();

    try {
      $headers = [
        'x-api-key' => env('lps.x_api_key'),
        'Content-Type' => 'application/json'
      ];
      $body = '{"usr_id":"' . $crmUserId . '","is_ib": ' . $isIb . '}';
      Log::info('Send request to ' . env('lps.dashboard_route') . ': ' . $body);

      $request = new Request('POST', env('lps.root_url') . env('lps.dashboard_route'), $headers, $body);
      $res = $client->sendAsync($request)->wait();

      $clientData = json_decode($res->getBody()->getContents(), true);
      Log::info('Receive request from ' . env('lps.dashboard_route') . ': ' . json_encode($clientData));

      return $this->result(200, 'Request Succefully ', ['dashboardData' => $clientData]);
    } catch (\Exception $e) {
      Log::info('Request Failed： ' . $e->getMessage());
      return $this->result(400, 'Failed to request: ' . $e->getMessage());
    }
  }
}
