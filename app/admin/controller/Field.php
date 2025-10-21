<?php
namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use app\admin\builder\AdminListBuilder;
use app\admin\builder\AdminConfigBuilder;
use app\admin\builder\AdminSortBuilder;

use app\common\model\Member as MemberModel;

/**
 * 后台扩展字段控制器
 */
class Field extends Admin
{
    /**
     * 构造方法
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 扩展用户信息分组列表
     */
    public function group()
    {
        $r = 20;
        $map[] = ['status', '>=', 0];
        $profileList = Db::name('field_group')->where($map)->order("sort asc")->paginate($r);
        $totalCount = Db::name('field_group')->where($map)->count();
        $page = $profileList->render();

        $profileList = $profileList->toArray()['data'];
        int_to_string($profileList);

        View::assign('title','Extended Information');
        View::assign('page',$page);
        View::assign('list', $profileList);
        
        return View::fetch();
    }

    /**
     * 添加、编辑分组信息
     * @param $id
     * @param $profile_name
     * @author dameng <59262424@qq.com>
     */
    public function editGroup($id = 0, $profile_name = '', $visiable = 1)
    {
        if (request()->isPost()) {
            $data['profile_name'] = $profile_name;
            $data['visiable'] = $visiable;
            if ($data['profile_name'] == '') {
                return $this->error('Group name cannot be empty!');
            }
            if ($id != '') {
                $res = Db::name('field_group')->where(['id'=>$id])->update($data);
            } else {
                $map['profile_name'] = $profile_name;
                $map['status'] = array('egt', 0);
                if (Db::name('field_group')->where($map)->count() > 0) {
                    return $this->error('A group with the same name already exists, please use a different group name!');
                }
                $data['status'] = 1;
                $data['create_time'] = time();
                $res = Db::name('field_group')->insert($data);
            }
            if ($res) {
                return $this->success($id == '' ? 'Group Added Successfully' : 'Group Edited Successfully', '', url('group')->build());
            } else {
                return $this->error($id == '' ? 'Add Failed' : 'Edit Failed');
            }
        } else {

            $builder = new AdminConfigBuilder();
            if ($id != 0) {
                $profile = Db::name('field_group')->where(['id'=>$id])->find();
                $builder->title('Edit Group Information');
            } else {
                $builder->title('Add Extended Information Group');
                $profile = [];
            }
            $builder
                ->keyReadOnly("id", 'ID')
                ->keyText('profile_name', 'Group Name')
                ->keyBool('visiable', 'Is Public');

            $builder
                ->data($profile);
            $builder
                ->buttonSubmit(url('editGroup'), $id == 0 ? lang('Add') : lang('Edit'))
                ->buttonBack()
                ->display();
        }
    }

    /**
     * 扩展分组排序
     */
    public function sortGroup($ids = null)
    {
        if (request()->isPost()) {
            $builder = new AdminSortBuilder($this->app);
            $builder->doSort('Field_group', $ids);
        } else {
            $map['status'] = array('egt', 0);
            $list = Db::name('field_group')->where($map)->order("sort asc")->select();
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['profile_name'];
            }
            $builder = new AdminSortBuilder();
            $builder->title('组排序');
            $builder->data($list);
            $builder->buttonSubmit(url('sortProfile'))
                    ->buttonBack()
                    ->display();
        }
    }

    /**
     * 设置分组状态：Delete=-1，Disable=0，Enable=1
     * @param $status
     */
    public function setGroupStatus()
    {
        $status = input('status',0 , 'intval');
        $id = array_unique((array)input('id', 0));
        if ($id[0] == 0) {
            return $this->error('Please select the data to operate on');
        }
        $id = is_array($id) ? $id : explode(',', $id);
        Db::name('field_group')->where('id' ,'in', $id)->update(['status'=> $status]);
        if ($status == -1) {
            return $this->success(lang('Delete'));
        } else if ($status == 0) {
            return $this->success(lang('Disable') . lang('Success'));
        } else {
            return $this->success(lang('Enable') . lang('Success'));
        }
    }

    /**
     * 扩展字段列表
     * @param $id
     */
    public function list()
    {
        $group_id = input('group_id', 0, 'intval');
        View::assign('group_id', $group_id);
        $group = Db::name('field_group')->where('id', '=', $group_id)->find();
        View::assign('group', $group);

        // 获取字段列表
        $map[] = ['status', '>' , 0];
        $map[] = ['group_id', '=', $group_id];
        $field_list = Db::name('field_setting')->where($map)->order("sort asc")->select()->toArray();
        $totalCount = Db::name('field_setting')->where($map)->count();

        // 表单类型
        $type_default = [
            'input' => '文本框',
            'radio' => '单选项',
            'checkbox' => '多选项',
            'select' => '下拉框',
            'time' => '日期',
            'textarea' => '文本域'
        ];


        foreach ($field_list as &$val) {
            $val['form_type'] = $type_default[$val['form_type']];
        }
        unset($val);

        View::assign('title','Extended Information');
        View::assign('list', $field_list);
        // 记录当前列表页的cookie
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        return View::fetch();
    }

    /**
     * 添加、编辑字段信息
     * @param $id
     * @param $group_id
     * @param $field_name
     * @param $child_form_type
     * @param $visiable
     * @param $required
     * @param $form_type
     * @param $form_default_value
     * @param $validation
     * @param $input_tips
     */
    public function editField()
    {
        if (request()->isPost()) {

            $data = input('');
            if ($data['field_name'] == '') {
                return $this->error('Field name cannot be empty!');
            }
            if ($data['field_alias'] == '') {
                return $this->error('Field description cannot be empty!');
            }

            //当表单类型为以下三种是默认值不能为空判断@MingYang
            $form_types = array('radio', 'checkbox', 'select');
            if (in_array($data['form_type'], $form_types)) {
                if ($data['form_default_value'] == '') {
                    return $this->error($data['form_type'] . 'Default value for form type cannot be empty');
                }
            }
            
            if (!empty($data['id'])) {
                Db::name('field_setting')->strict(true)->where(['id'=>$data['id']])->update($data);
                $res = Db::name('field_setting')->where(['id'=>$data['id']])->value('id');
            } else {
                $map['field_name'] = $data['field_name'];
                $map['status'] = array('egt', 0);
                $map['group_id'] = $data['group_id'];
                if (Db::name('field_setting')->where($map)->count() > 0) {
                    return $this->error('A field with the same name already exists in this group, please use a different name!');
                }
                $data['status'] = 1;
                $data['create_time'] = time();
                $data['sort'] = 0;
                $res = Db::name('field_setting')->strict(true)->insertGetId($data);
            }
            
            return $this->success($data['id'] == '' ? 'Field Added Successfully' : 'Field Edited Successfully', $res, cookie('__forward__'));

        } else {
            $id = input('id');
            $group_id = input('group_id');
            $builder = new AdminConfigBuilder();
            if (!empty($id)) {
                $field_setting = Db::name('field_setting')->where('id', '=', $id)->find();
                $builder->title('Field Settings');

            } else {
                $builder->title('Add Field' . 'New Field');

                $field_setting['group_id'] = $group_id;
                $field_setting['visiable'] = 1;
                $field_setting['required'] = 1;
            }
            $type_default = array(
                'input' => '单行文本框',
                'textarea' => '多行文本框',
                'radio' => '单选框',
                'checkbox' => '多选框',
                'select' => '下拉选择框',
                'time' => '日期',
            );

            $builder
            ->keyReadOnly("id", 'ID')
            ->keyReadOnly('group_id', 'Group ID')
            ->keyText('field_name', 'Field Name','Only supports lowercase English letters and "_"')
            ->keyText('field_alias', 'Field Description')
            ->keySelect('form_type', 'Form Type', '', $type_default)
            ->keyTextArea('form_default_value', "Form Value Options", "Separate multiple values with '|', e.g., male|female")
            ->keyText('validation', 'Form Validation Rules', "Separate multiple rules with '|', e.g., require|max:25")
            ->keyText('input_tips', 'User Input Tips', 'Tips for users on how to input this field')
            ->keyBool('visiable', 'Is Public')
            ->keyBool('required', 'Is Required')
            ->data($field_setting)
            ->buttonSubmit(url('editField'), $id == 0 ? 'Add' : 'Edit')
            ->buttonBack();

            $builder->display();
        }
    }

    /**
     * 设置字段状态：Delete=-1，Disable=0，Enable=1
     * @param $ids
     * @param $status
     * @author dameng<59262424@qq.com>
     */
    public function setFieldStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        return $builder->doSetStatus('field_setting', $ids, $status);
    }
}