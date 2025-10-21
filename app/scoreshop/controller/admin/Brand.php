<?php

namespace app\scoreshop\controller\admin;

use think\App;
use think\facade\Db;
use think\facade\View;
use app\admin\builder\AdminConfigBuilder;
use app\admin\builder\AdminListBuilder;
use app\common\model\Brand as BrandModel;

/**
 * 品牌相关功能控制器
 */
class Brand extends Admin
{

  protected $brandModel;

  /**
   * 构造方法
   * @access public
   */
  public function __construct()
  {
    parent::__construct();

    $this->brandModel = new BrandModel();
  }

  /**
   * 品牌列表
   * @return [type] [description]
   */
  public function lists()
  {
    //读取数据
    $map[] = ['status', '>', -1];
    $list = $this->brandModel->getBrandList($map);
    //dump($list);
    //显示页面
    $builder = new AdminListBuilder();
    $builder
      ->title('Brand')
      ->buttonNew(url('editBrand'))
      ->setStatusUrl(url('setBrandStatus'))
      // ->buttonEnable()
      // ->buttonDisable()
      ->buttonDelete(url('delBrand'), 'Delete')
      ->keyId()
      ->keyText('name_en', 'Name')
      ->keyText('slug', 'Slug')
      ->keyStatus()
      ->keyDoActionEdit('editBrand?id=###')
      ->keyDoActionDelete('delBrand?ids=###')
      ->data($list)
      ->display();
  }

  /**
   * 编辑品牌
   */
  public function editBrand()
  {
    $aId = input('id', 0, 'intval');

    if (request()->isPost()) {
      $inputData = input();
      $data['name_en'] = $inputData['name_en'];
      $data['name_ar'] = $inputData['name_ar'];
      $data['name_hi'] = $inputData['name_hi'];
      $data['name_id'] = $inputData['name_id'];
      $data['name_ja'] = $inputData['name_ja'];
      $data['name_th'] = $inputData['name_th'];
      $data['name_vi'] = $inputData['name_vi'];
      $data['name_ms'] = $inputData['name_ms'];
      $data['name_zh'] = $inputData['name_zh'];
      $data['name_pt'] = $inputData['name_pt'];
      $data['name_es'] = $inputData['name_es'];
      $data['status'] = intval($inputData['status']);
      $data['slug'] = $inputData['slug'];
      $data['image'] = $inputData['image'];

      if (empty($data['name_en'])) {
        return $this->error('Name in English cannot be empty');
      }

      if (empty($data['slug'])) {
        return $this->error('Slug cannot be empty');
      }

      if (empty($data['image'])) {
        return $this->error('Image cannot be empty');
      }

      if (!empty($aId)) {
        $data['id'] = $aId;
        $res = $this->brandModel->editBrand($data);
      } else {
        $res = $this->brandModel->addBrand($data);
      }
      if ($res) {
        return $this->success(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Success'), '', '/scoreshop/admin.brand/lists.html');
      } else {
        return $this->error(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Failed'));
      }
    } else {

      if ($aId != 0) {
        $type = $this->brandModel->getBrand(['id' => $aId]);
      } else {
        $type = ['status' => 1, 'sort' => 0];
      }

      $builder = new AdminConfigBuilder();
      $builder
        ->title(($aId == 0 ? 'Add' : 'Edit') . 'Brand')
        ->keyId()
        ->keySingleImage('image', 'Image', '')
        ->keyText('name_en', 'Name (English)')
        ->keyText('name_ar', 'Name (Arabic)')
        ->keyText('name_hi', 'Name (Hindi)')
        ->keyText('name_id', 'Name (Indonesia)')
        ->keyText('name_ja', 'Name (Japanese)')
        ->keyText('name_th', 'Name (Thai)')
        ->keyText('name_vi', 'Name (Vietnamese)')
        ->keyText('name_ms', 'Name (Melayu)')
        ->keyText('name_zh', 'Name (Chinese)')
        ->keyText('name_pt', 'Name (Portuguese)')
        ->keyText('name_es', 'Name (Spanish)')
        ->keyText('slug', 'Slug')
        ->keySelect('status', 'Status', null, array(0 => 'Disable', 1 => 'Enable'))
        ->data($type)
        ->buttonSubmit(url('editBrand'))
        ->buttonBack()
        ->display();
    }
  }

  /**
   * 设置品牌状态
   */
  public function setBrandStatus($ids, $status)
  {
    $ids = array_unique((array)$ids);
    $ids = implode(',', $ids);
    $rs = $this->brandModel->where('id', 'in', $ids)->update(['status' => $status]);
    if ($rs) {
      return $this->success('Settings Saved', $_SERVER['HTTP_REFERER']);
    } else {
      return $this->error('Settings Failed');
    }
  }

  /**
   * 删除品牌
   */
  public function delBrand()
  {
    $ids = input('ids/a');
    $res = $this->brandModel->delBrand($ids);
    if ($res) {
      return $this->success('Deleted Successfully');
    } else {
      return $this->error('Deletion Failed');
    }
  }
}
