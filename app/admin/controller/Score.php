<?php
namespace app\admin\controller;

use think\App;
use think\facade\Db;
use think\facade\View;
use app\admin\builder\AdminConfigBuilder;
use app\admin\builder\AdminListBuilder;
use app\common\model\ScoreLog as ScoreLogModel;
use app\common\model\ScoreType as ScoreTypeModel;

/**
 * 积分相关功能控制器
 */
class Score extends Admin {

    protected $scoreLogModel;
    protected $scoreTypeModel;

    /**
     * 构造方法
     * @access public
     */
    public function __construct()
    {
        parent::__construct();

        $this->scoreLogModel = new ScoreLogModel();
        $this->scoreTypeModel = new ScoreTypeModel();
    }

    /**
     * 积分日志
     * @param  integer $r [description]
     * @param  integer $p [description]
     * @return [type]     [description]
     */
    public function log($r=20){

        $aUid=input('uid',0,'');
        $map=[];
        if($aUid){
            $map['uid']=$aUid;
        }
        
        $scoreLog = $this->scoreLogModel->where($map)->order('create_time desc')->paginate($r);
        $totalCount = $this->scoreLogModel->count();
        //分页HTML
        $page = $scoreLog->render();
        //转数组处理
        $scoreLog = $scoreLog->toArray()['data'];

        $scoreTypes = $this->scoreTypeModel->getTypeListByIndex();

        foreach ($scoreLog as &$v) {
            if(empty($v['uid'])) $v['uid'] = 0;
            $v['adjustType'] = $v['action']== 'inc'?'增加':'减少';
            $v['scoreType'] = $scoreTypes[$v['type']]['title'];
            $class = $v['action'] == 'inc' ? 'text-success':'text-danger';
            $v['value']='<span class="'.$class.'">' .  ($v['action'] == 'inc'?'+':'-'). $v['value']. $scoreTypes[$v['type']]['unit'].'</span>';
            $v['finally_value'] = $v['finally_value']. $scoreTypes[$v['type']]['unit'];
        }
        unset($v);

        $builder = new AdminListBuilder();

        $builder->title('Score Log');
        $builder->data($scoreLog);
        $builder->page($page);
        $builder
            ->keyId()
            ->keyUid()
            ->keyText('scoreType','Score Type')
            ->keyText('adjustType','Adjustment Type')
            ->keyHtml('value','Score Change')
            ->keyText('finally_value','Final Score')
            ->keyText('remark','Change Description')
            ->keyCreateTime();

        $builder->search('Search','uid','text','Enter UID');
        $builder->button('Clear Log',['url'=>url('clear'),'class'=>'btn btn-danger ajax-get confirm']);
    
        $builder->display();
    }

    /**
     * 清空积分日志
     */
    public function clear()
    {
        Db::name('ScoreLog')->where('id', '>', 0)->delete();
        return $this->success('Cleared successfully.',url('scoreLog'));
    }

    /**
     * 积分列表
     * @return [type] [description]
     */
    public function type()
    {
        //读取数据
        $map[] = ['status' ,'>', -1];
        $list = $this->scoreTypeModel->getTypeList($map);
        //dump($list);
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title('Score Type')
            ->suggest('Cannot delete id<=4')
            ->buttonNew(url('editType'))
            ->setStatusUrl(url('setTypeStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->buttonDelete(url('delType'),'Delete')
            ->keyId()
            ->keyText('title', 'Title')
            ->keyText('unit', 'Unit')
            ->keyStatus()
            ->keyDoActionEdit('editType?id=###')
            ->keyDoActionDelete('delType?ids=###')
            ->data($list)
            ->display();
    }

    /**
     * 编辑积分类型
     */
    public function editType()
    {
        $aId = input('id', 0, 'intval');
        
        if (request()->isPost()) {
            $data['title'] = input('post.title', '', 'text');
            $data['status'] = input('post.status', 1, 'intval');
            $data['unit'] = input('post.unit', '', 'text');

            if (!empty($aId)) {
                $data['id'] = $aId;
                $res = $this->scoreTypeModel->editType($data);
            } else {
                $res = $this->scoreTypeModel->addType($data);
            }
            if ($res) {
                return $this->success(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Success'));
            } else {
                return $this->error(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Failed'));
            }
        } else {
            
            if ($aId != 0) {
                $type = $this->scoreTypeModel->getType(['id' => $aId]);
            } else {
                $type = ['status' => 1, 'sort' => 0];
            }

            $builder = new AdminConfigBuilder();
            $builder
                ->title(($aId == 0 ? 'Add' : 'Edit') . 'Score Type')
                ->keyId()
                ->keyText('title', 'Title')
                ->keyText('unit', 'Unit')
                ->keySelect('status', 'Status', null, array(-1 => 'Delete', 0 => 'Disable', 1 => 'Enable'))
                ->data($type)
                ->buttonSubmit(url('editType'))
                ->buttonBack()
                ->display();
        }
    }

    /**
     * 设置积分类型状态
     */
    public function setTypeStatus($ids, $status)
    {
        $ids = array_unique((array)$ids);
        $ids = implode(',',$ids);
        $rs = $this->scoreTypeModel->where('id','in', $ids)->update(['status' => $status]);
        if ($rs) {
            return $this->success('Settings Saved', $_SERVER['HTTP_REFERER']); 
        }else{
            return $this->error('Settings Failed');
        }
    }

    /**
     * 删除积分类型
     */
    public function delType()
    {
        $ids = input('ids/a');
        $res = $this->scoreTypeModel->delType($ids);
        if ($res) {
            return $this->success('Deleted Successfully');
        } else {
            return $this->error('Deletion Failed');
        }
    }

}