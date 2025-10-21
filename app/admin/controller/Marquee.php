<?php

namespace app\admin\controller;

use app\admin\builder\AdminConfigBuilder;
use app\admin\builder\AdminListBuilder;
use app\common\model\Marquee as ModelMarquee;

class Marquee extends Admin
{

  protected $marqueeModel;

  /**
   * @access public
   */
  public function __construct()
  {
    parent::__construct();

    $this->marqueeModel = new ModelMarquee();
  }

  /**
   * @return [type] [description]
   */
  public function lists()
  {
    $map[] = ['status', '>', -1];
    $list = $this->marqueeModel->getMarqueeList($map);

    $builder = new AdminListBuilder();
    $builder
      ->title('Marquee')
      ->buttonNew(url('editMarquee'))
      ->buttonDelete(url('delMarquee'), 'Delete')
      ->keyId()
      ->keyText('content_en', 'Content')
      ->keyText('url', 'URL')
      ->keyText('order', 'Order')
      ->keyStatus()
      ->keyDoActionEdit('editMarquee?id=###')
      ->keyDoActionDelete('delMarquee?ids=###')
      ->data($list)
      ->display();
  }

  public function editMarquee()
  {
    $aId = input('id', 0, 'intval');

    if (request()->isPost()) {
      $inputData = input();
      $data['content_en'] = $inputData['content_en'];
      $data['content_zh'] = $inputData['content_zh'];
      $data['content_hi'] = $inputData['content_hi'];
      $data['content_id'] = $inputData['content_id'];
      $data['content_ja'] = $inputData['content_ja'];
      $data['content_th'] = $inputData['content_th'];
      $data['content_vi'] = $inputData['content_vi'];
      $data['content_ms'] = $inputData['content_ms'];
      $data['content_ar'] = $inputData['content_ar'];
      $data['content_pt'] = $inputData['content_pt'];
      $data['content_es'] = $inputData['content_es'];
      $data['url'] = $inputData['url'];
      $data['status'] = intval($inputData['status']);
      $data['order'] = $inputData['order'] ?? 0;

      if (empty($data['content_en'])) {
        return $this->error('English Content cannot be null');
      }

      if (!empty($aId)) {
        $data['id'] = $aId;
        $res = $this->marqueeModel->editMarquee($data);
      } else {
        $res = $this->marqueeModel->addMarquee($data);
      }
      if ($res) {
        return $this->success(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Success'), '', '/admin/Marquee/lists.html');
      } else {
        return $this->error(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Failed'));
      }
    } else {

      if ($aId != 0) {
        $type = $this->marqueeModel->getMarquee(['id' => $aId]);
      } else {
        $type = ['status' => 1, 'sort' => 0];
      }

      $builder = new AdminConfigBuilder();
      $builder
        ->title(($aId == 0 ? 'Add' : 'Edit') . 'Marquee')
        ->keyId()
        ->keyText('content_en', 'Content (English)')
        ->keyText('content_zh', 'Content (Chinese)')
        ->keyText('content_hi', 'Content (Hindi)')
        ->keyText('content_id', 'Content (Indonesia)')
        ->keyText('content_ja', 'Content (Japanese)')
        ->keyText('content_th', 'Content (Thai)')
        ->keyText('content_vi', 'Content (Vietnamese)')
        ->keyText('content_ms', 'Content (Melayu)')
        ->keyText('content_ar', 'Content (Arabic)')
        ->keyText('content_pt', 'Content (Portuguese)')
        ->keyText('content_es', 'Content (Spanish)')
        ->keyText('url', 'Url')
        ->keyInteger('order', 'Order')
        ->keySelect('status', 'Status', null, array(0 => 'Disable', 1 => 'Enable'))
        ->data($type)
        ->buttonSubmit(url('editMarquee'))
        ->buttonBack()
        ->display();
    }
  }

  public function delMarquee()
  {
    $ids = input('ids/a');
    $res = $this->marqueeModel->delMarquee($ids);
    if ($res) {
      return $this->success('Delete Successfully');
    } else {
      return $this->error('Failed to delete');
    }
  }
}
