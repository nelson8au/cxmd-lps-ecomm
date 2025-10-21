<?php
namespace app\admin\controller;

use think\facade\Cache;
use think\facade\Db;
use think\facade\View;
use app\common\model\Crontab as CrontabModel;
use app\common\logic\Crontab as CrontabLogic;
use app\common\model\CrontabLog as CrontabLogModel;

class Crontab extends Admin{

    protected $CrontabLogic;
    protected $CrontabModel;
    protected $CrontabLogModel;

    function __construct()
    {
        parent::__construct();
        $this->CrontabModel = new CrontabModel();
        $this->CrontabLogic = new CrontabLogic();
        $this->CrontabLogModel = new CrontabLogModel();
    }

    /**
     * 任务列表
     */
    public function list(){
        $map = [
            ['status' ,'between' ,[0,1]],
            ['shopid' ,'=' ,$this->shopid]
        ];
        $list = $this->CrontabModel->getListByPage($map,'id DESC','id,title,description,execute,cycle,day,hour,minute,status,update_time');
        $pager = $list->render();
        $list = $list->toArray();
        foreach ($list['data'] as &$item){
            $item = $this->CrontabLogic->formatData($item);
        }
        unset($item);
        View::assign([
            'pager' => $pager,
            'list' => $list['data']
        ]);

        $this->setTitle('Automation');
        
        return view();
    }

    public function edit(){
        if (request()->isPost()){
            $params = input('post.');
            $data = [
                'id'        =>  $params['id'],
                'shopid'    =>  $this->shopid,
                'title'     =>  $params['title'],
                'description'   =>  $params['description'],
                'execute'   =>  $params['execute'],
                'cycle'     =>  $params['cycle'],
                'day'       =>  $params['day'],
                'hour'      =>  $params['hour'],
                'minute'    =>  $params['minute'],
                'status'    =>  $params['status']
            ];
            $result = $this->CrontabModel->edit($data);
            if ($result){
                return $this->success('Settings Saved','',url('list'));
            }
            return $this->error('Network error, please try again later');
        }
        $id = input('id',0);
        $data = [];
        if (!empty($id)){
            $data = $this->CrontabModel->getDataById($id);
            if ($data){
                $data = $data->toArray();
            }
        }
        View::assign([
            'data' => $data
        ]);
        return \view();
    }

    public function log(){
        $cid = input('cid',0);
        $map = [
            ['status', 'between', [0,1]],
            ['shopid', '=', $this->shopid],
            ['cid', '=', $cid]
        ];
        $rows = input('rows',10);
        $list = $this->CrontabLogModel->getListByPage($map,'id DESC','*',$rows);
        $pager = $list->render();
        $list = $list->toArray();
        unset($item);
        View::assign([
            'pager' => $pager,
            'list'  => $list['data'],
            'cid'   => $cid
        ]);
        return view();
    }

    /**
     * 设置状态
     */
    public function status(int $status = 0)
    {
        $ids = input('ids/a');
        !is_array($ids)&&$ids=explode(',',$ids);
        $status = input('status', 0, 'intval');
        $title = 'Update';
        if($status == 0){
            $title = 'Disable';
        }
        if($status == 1){
            $title = 'Enable';
        }
        if($status == -1){
            $title = 'Delete';
        }
        $data['status'] = $status;

        $res = $this->CrontabModel->where('id', 'in', $ids)->update($data);
        if($res){
            return $this->success($title . 'Success');
        }else{
            return $this->error($title . 'Failed');
        }
    }

    /**
     * 清空日志表
     */
    public function clear()
    {
        $prefix = config('database.connections.mysql.prefix');
        $table = $prefix . 'crontab_log';
        Db::execute("truncate TABLE {$table}");

        return $this->success('Task log cleared successfully');
    }
}