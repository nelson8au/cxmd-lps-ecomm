<?php

declare(strict_types=1);

namespace app\ucenter\controller;

use app\common\model\Member;
use think\facade\View;
use app\common\model\ScoreType;
use app\common\model\ScoreLog;
use GuzzleHttp\Psr7\Request;
use think\facade\Log;
use think\facade\Session;

class Score extends Base
{
  protected $middleware = [
    'app\\common\\middleware\\CheckAuth',
  ];

  public function __construct()
  {
    parent::__construct();

    $user = query_user(get_uid());
    View::assign('user', $user);
  }

  /**
   * 我的积分
   * @return [type] [description]
   */
  public function index()
  {
    $scoreTypeModel = new ScoreType();
    // 用户积分类型列表
    $scores = $scoreTypeModel->getTypeList(['status' => 1]);
    foreach ($scores as &$v) {
      $v['value'] = $scoreTypeModel->getUserScore(is_login(), $v['id']);
    }
    unset($v);
    View::assign('scores', $scores);

    // 获取积分日志列表
    $scoreLogModel = new ScoreLog();
    $lists = $scoreLogModel->getListByPage([
      ['uid', '=', get_uid()],
    ], 'create_time desc', '*', 10);
    $pager = $lists->render();
    $lists = $lists->toArray();
    foreach ($lists['data'] as &$v) {
      $type = $scoreTypeModel->getType(['id' => $v['type']])->toArray();
      $v['type'] = $type;
      if (!empty($v['create_time'])) {
        $v['create_time_str'] = time_format($v['create_time']);
        $v['create_time_friendly_str'] = friendly_date($v['create_time']);
      }
    }
    unset($v);
    View::assign('pager', $pager);
    View::assign('lists', $lists);

    // 设置页面TITLE
    $this->setTitle('我的积分');
    View::assign('tab', 'myScore');
    // 输出模板
    return View::fetch();
  }

  //积分规则
  public function rule()
  {

    View::assign('tab', 'scoreRule');
    $this->setTitle('积分规则');
    return View::fetch();
  }

  /**
   * 积分等级
   */
  public function estate($uid)
  {
    Session::set('crmUserId', null);
    Session::set('isIb', null);

    $user = Member::where('uid', $uid)->find();

    if (!$user) {
      return $this->error(404, 'User not found', '/admin/member/index.html');
    }

    if ($user->crm_user_id === null) {
      return $this->error(404, 'Invalid user', '/admin/member/index.html');
    }

    $client = new \GuzzleHttp\Client();
    // $crmUserId = Session::get('crmUserId');
    // $sessionIsIb = Session::get('isIb');
    $crmUserId = $user->crm_user_id;
    $sessionIsIb = $user->ib_id !== null;

    if ($crmUserId === null || $sessionIsIb === null) {
      $commonMemberModel = new Member();
      $commonMemberModel->logout(is_login());
      return $this->success('Logout Successful', '', request()->domain());
    }

    $isIb = $sessionIsIb ? 'true' : 'false';

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

      $thresholdUnlock = isset($clientData['tr_nd_lps_coeff']) && isset($clientData['dcnd_lps']) ? $clientData['tr_nd_lps_coeff'] * $clientData['dcnd_lps'] : 0;

      $englishRegex = '/[a-zA-Z]/';
      if (preg_match($englishRegex, $clientData['ls'])) {
        $currentLevelInLowerCase = strtolower($clientData['ls']);
        $nextLevelInLowerCase = $clientData['next_ls_name'] ? strtolower($clientData['next_ls_name']) : null;
      } else {
        $levelDataMapped = [
          '白银会员' => 'silver',
          '黄金会员' => 'gold',
          '白金会员' => 'platinum',
          '钻石会员' => 'diamond',
        ];

        $currentLevelInLowerCase = $levelDataMapped[$clientData['ls']];
        $nextLevelInLowerCase = $clientData['next_ls_name'] ? $levelDataMapped[$clientData['next_ls_name']] : null;
      }

      View::assign('isIb', $isIb);
      View::assign('thresholdUnlock', $thresholdUnlock);
      View::assign('currentLevelInLowerCase', $currentLevelInLowerCase);
      View::assign('nextLevelInLowerCase', $nextLevelInLowerCase);
      View::assign('clientData', $clientData);
      View::assign('crmUserId', $crmUserId);
      View::assign('appHost', config('app.app_host'));
      View::assign('tab', 'scoreEstate');
      // 设置页面title
      $this->setTitle('Loyalty Status');

      if (isset($this->params['from'])) {
        View::assign('logout', true);
      } else {
        View::assign('logout', false);
      }

      // 输出模板
      return View::fetch();
    } catch (\Exception $e) {
      $this->error('Request Failed：' . $e->getMessage());
    }
  }
}
