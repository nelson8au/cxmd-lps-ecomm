<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Marquee as ModelMarquee;

class Marquee extends Api
{
  protected $marqueeModel;

  function __construct()
  {
    parent::__construct();

    $this->marqueeModel = new ModelMarquee();
  }

  public function index($lang = 'en')
  {
    $contentField = 'content_' . $lang;
    $marquees = ModelMarquee::where('status', 1)
      ->field($contentField . ' as content_lang, url')
      ->order('order', 'asc')
      ->select()
      ->map(function ($marquee) {
        $marquee['content'] = !empty($marquee['content_lang']) ? $marquee['content_lang'] : $marquee['content'];
        unset($marquee['content_lang']);
        return $marquee;
      });

    return $this->result(200, 'Retrieved Successfully', $marquees);
  }

  public function store()
  {
    if (request()->isPost()) {
      $data['content_en'] = input('content_en', '', 'text');
      $data['content_zh'] = input('content_zh', '', 'text');
      $data['content_hi'] = input('content_hi', '', 'text');
      $data['content_id'] = input('content_id', '', 'text');
      $data['content_ja'] = input('content_ja', '', 'text');
      $data['content_th'] = input('content_th', '', 'text');
      $data['content_vi'] = input('content_vi', '', 'text');
      $data['content_ms'] = input('content_ms', '', 'text');
      $data['content_ar'] = input('content_ar', '', 'text');
      $data['content_pt'] = input('content_pt', '', 'text');
      $data['content_es'] = input('content_es', '', 'text');
      $data['url'] = input('post.url', '', 'text');
      $data['status'] = 1;
      $data['order'] = ModelMarquee::max('order') + 1;

      if (!$data['content_en'] || !$data['url']) {
        return $this->result(400, 'The english content or URL cannot be null');
      }

      $res = $this->marqueeModel->addMarquee($data);

      return $this->result(200, 'Added successfully', $res);
    }
  }
}
