<?php
namespace app\admin\controller;

use think\facade\View;
use think\exception\ValidateException;
use app\common\validate\Author as AuthorValidate;
use app\admin\builder\AdminConfigBuilder;
use app\admin\builder\AdminListBuilder;
use app\common\model\Author as AuthorModel;
use app\common\logic\Author as AuthorLogic;
use app\common\model\AuthorGroup as AuthorGroupModel;

class Author extends Admin
{
    protected $AuthorModel;
    protected $AuthorLogic;
    protected $AuthorGroupModel;

    public function __construct()
    {
        parent::__construct();
        $this->AuthorModel = new AuthorModel();
        $this->AuthorLogic = new AuthorLogic();
        $this->AuthorGroupModel = new AuthorGroupModel();
    }

    /**
     * 作者列表
     */
    public function lists()
    {
        $map = [];
        $keyword = input('keyword','','text');
        View::assign('keyword', $keyword);
        if(!empty($keyword)){
            $map[] = ['name', 'like', '%'.$keyword.'%'];
        }
        $status = input('status', 'all');
        if($status === 'all'){
            $map[] = ['status', '>', -3];
        }
        if(intval($status) == 1){
            $map[] = ['status', '=', 1];
        }
        if(intval($status) == 0 && $status != 'all'){
            $map[] = ['status', '=', 0];
        }
        if(intval($status) == -1){
            $map[] = ['status', '=', -1];
        }
        if(intval($status) == -2){
            $map[] = ['status', '=', -2];
        }
        if(intval($status) == -3){
            $map[] = ['status', '=', -3];
        }
        View::assign('status', $status);
        $rows = input('rows',20, 'intval');
        $order_field = input('order_field', 'id', 'text');
        $order_type = input('order_type', 'desc', 'text');
        $order = $order_field . ' ' . $order_type;

        // 获取分页列表
        $lists = $this->AuthorModel->getListByPage($map, $order, '*', $rows);
        // 分页按钮
        $pager = $lists->render();
        View::assign('pager',$pager);

        // 格式化数据
        $lists = $lists->toArray();
        foreach($lists['data'] as &$val){
            $val = $this->AuthorLogic->formatData($val);
        }
        unset($val);

        // ajax返回
        if(request()->isAjax()){
            return $this->success('success', $lists);
        }
        View::assign('lists',$lists);
        // 记录当前列表页的cookie
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        // 设置页面title
        $this->setTitle('Author List');
        // 输出模板
        return View::fetch();
    }

    /**
     * 编辑/添加
     */
    public function edit()
    {   
        $id = input('id', 0, 'intval');
        $title = $id ? "Edit" : "Add";
        View::assign('title', $title);

        if (request()->isPost()) {
            $data = input();
            $data['shopid'] = $this->shopid;
            // 数据验证
            try {
                validate(AuthorValidate::class)->scene('edit')->check($data);
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                return $this->error($e->getError());
            }
            $res = $this->AuthorModel->edit($data);
            if($res){
                return $this->success($title . 'Success',$res, cookie('__forward__'));
            }else{
                return $this->success($title . 'Failed');
            }
        }else{
            // 初始化数据结构
            $data = [];
            $data['id'] = 0;
            $data['uid'] = 0;
            $data['group_id'] = 0;
            $data['name'] = '';
            $data['description'] = '';
            $data['cover'] = '';
            $data['avatar_card'] = '';
            $data['certificate'] = '';
            $data['content'] = '';
            $data['professional'] = '';
            $data['sort'] = 0;
            $data['status'] = 0;
            $data['reason'] = '';
            $data['user_info'] = [];
            if(!empty($id)){
                $data = $this->AuthorModel->getDataById($id);
                $data = $this->AuthorLogic->formatData($data);
            }
            View::assign('data', $data);
            // 获取创作者分组
            $group_map = [
                ['status', '=', 1]
            ];
            $group = $this->AuthorGroupModel->getList($group_map, 999);
            View::assign('group', $group);
            // 设置页面Title
            $this->setTitle($title . 'Author');
            // 输出模板
            return View::fetch();
        }
    }

    /**
     * 设置内容状态
     */
    public function status()
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

        $res = $this->AuthorModel->where('id', 'in', $ids)->update($data);
        if($res){
            return $this->success($title . 'Success');
        }else{
            return $this->error($title . 'Failed');
        }  
    }

    /**
     * 检查用户创造者绑定状态，禁止用户绑定多个创造者
     */
    public function checkBind()
    {
        $id = intval(input('id'));
        $uid = intval(input('uid'));

        $res = $this->AuthorModel->getDataByMap([
            ['shopid', '=', 0],
            ['uid', '=', $uid]
        ]);
        if($res && $res['id'] != $id){
            return $this->error('This user is already bound to an author data');
        }else{
            return $this->success('Verification successful, binding to author allowed');
        }
    }

    /**
     * 状态审核
     */
    public function verify()
    {
        $id = input('id',0,'intval');
        View::assign('id', $id);
        if (request()->isPost()) {
            $status = input('status', -1, 'intval');
            $reason = input('reason', '', 'text');
            $res = $this->AuthorModel->where('id', $id)->update([
                'status' => $status,
                'reason' => $reason
            ]);

            if($res){
                return $this->success('Success');
            }else{
                return $this->error('Failed');
            }  
        }

        if(!empty($id)){
            $data = $this->AuthorModel->getDataById($id);
            $data = $this->AuthorLogic->formatData($data);
        }
        View::assign('data',$data);

        // 输出模板
        return View::fetch();
    }

    /**
     * 创造者分组
     */
    public function groupList()
    {
        //读取数据
        $map[] = ['status', '>', -1];
        $list = $this->AuthorGroupModel->getList($map);
        // 记录当前列表页的cookie
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title('Author Type')
            ->suggest('Cannot delete id<=4')
            ->buttonNew(url('groupEdit'))
            ->setStatusUrl(url('groupStatus'))
            ->buttonEnable()
            ->buttonDisable()
            ->buttonDelete(url('groupStatus'),'Delete')
            ->keyId()
            ->keyText('title', 'Name')
            ->keyStatus()
            ->keyDoActionEdit('groupEdit?id=###')
            ->keyDoActionDelete('groupStatus?ids=###&status=-1')
            ->data($list)
            ->display();
    }

    /**
     * 编辑分组
     */
    public function groupEdit()
    {
        $id = input('id', 0, 'intval');
        if (request()->isPost()) {
            $data = input();
            if (!empty($id)) {
                $res = $this->AuthorGroupModel->edit($data);
            } else {
                if ($this->AuthorGroupModel->where('title', '=', $data['title'])->count() > 0) {
                    return $this->error('A group with the same name already exists, please use a different group name!');
                }
                $res = $this->AuthorGroupModel->edit($data);
            }
            if ($res) {
                return $this->success(empty($id) ? 'New Group Added' : 'Edit Group Successful', $res, Cookie('__forward__'));
            } else {
                return $this->error(empty($id) ? 'Add Group Failed' : 'Edit Group Failed');
            }
        } else {

            $builder = new AdminConfigBuilder();
            if ($id != 0) {
                $profile = $this->AuthorGroupModel->where(['id'=>$id])->find();
                $builder->title('Edit Author Type');
            } else {
                $builder->title('Add Author Type');
                $profile = [];
            }
            
            $builder
                ->keyReadOnly("id", 'ID')
                ->keyText('title', 'Name')
                ->keyStatus('status','Status')
                ->data($profile);
            $builder
                ->buttonSubmit(url('groupEdit'), $id == 0 ? lang('Add') : lang('Edit'))
                ->buttonBack()
                ->display();
        }
    }

    /**
     * 设置分组状态
     */
    public function groupStatus($ids, $status)
    {
        $ids = array_unique((array)$ids);
        $ids = implode(',',$ids);
        $rs = $this->AuthorGroupModel->where('id','in', $ids)->update(['status' => $status]);
        if ($rs) {
            return $this->success('Settings Saved', $_SERVER['HTTP_REFERER']); 
        }else{
            return $this->error('Settings Failed');
        }
    }

}