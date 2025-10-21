<?php

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use app\admin\model\AuthRule;
use app\admin\model\AuthGroup;

class Auth extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 权限组列表
     */
    public function index()
    {
        $map[] = ['module', '=', 'admin'];
        $map[] = ['status', '>', -1];
        $list = Db::name('AuthGroup')->where($map)->order('id asc')->select()->toArray();
        $list = int_to_string($list);

        $this->setTitle('User Group Management');
        View::assign('_list', $list);
        View::assign('_use_tip', true);
        // 记录当前列表页的cookie
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        // 输出模板
        return View::fetch();
    }

    /**
     * 编辑用户组
     */
    public function editGroup()
    {
        $id = input('id', 0, 'intval');
        if (request()->isPost()) {
            $data = input();
            if (isset($data['rules']) && !empty($data['rules'])) {
                sort($data['rules']);
                $data['rules'] = implode(',', array_unique($data['rules']));
            } else {
                $data['rules'] = '';
            }

            $data['module'] = 'admin';
            $data['type'] = AuthGroup::TYPE_ADMIN;

            if ($data) {
                $AuthGroup = new AuthGroup();
                $res = $AuthGroup->editData($data);
                if ($res === false) {
                    return $this->error('Failed');
                } else {
                    return $this->success('Success!', $res, cookie('__forward__'));
                }
            } else {
                return $this->error('Failed');
            }
        } else {
            $auth_group = Db::name('AuthGroup')->where(['module' => 'admin', 'type' => AuthGroup::TYPE_ADMIN])->find((int)$id);

            View::assign('auth_group', $auth_group);
            $this->setTitle('Edit User Group');

            return View::fetch();
        }
    }

    /**
     * 用户组状态修改
     */
    public function changeStatus($method = null)
    {
        $ids = input('id/a');

        if (empty($ids)) {
            return $this->error('Please select the data to operate on');
        }

        switch (strtolower($method)) {
            case 'forbidgroup':
                return $this->forbid('AuthGroup');
                break;
            case 'resumegroup':
                return $this->resume('AuthGroup');
                break;
            case 'deletegroup':
                if (in_array(1, $ids) || in_array(2, $ids) || in_array(3, $ids)) {
                    return $this->error('System default groups cannot be deleted');
                }
                return $this->delete('AuthGroup');
                break;
            default:
                return $this->error($method . 'Failed');
        }
    }

    /**
     * 用户组授权用户列表
     * @author 大蒙 <59262424@qq.com>
     */
    public function user()
    {
        $group_id = input('group_id', 1, 'intval');
        View::assign('group_id', $group_id);
        if (empty($group_id)) {
            return $this->error('Parameter Error');
        }
        // 权限组列表
        $auth_group = Db::name('AuthGroup')->where(['status' => 1, 'module' => 'admin', 'type' => AuthGroup::TYPE_ADMIN])->field('id,title,rules')->select()->toArray();
        View::assign('auth_group', $auth_group);

        $prefix = config('database.connections.mysql.prefix');
        $l_table = $prefix . (AuthGroup::MEMBER);
        $r_table = $prefix . (AuthGroup::AUTH_GROUP_ACCESS);
        $where = [
            ['a.group_id', '=', $group_id],
            ['status', '>=', 0]
        ];
        $list = Db::table($l_table . ' m')->join($r_table . ' a ', ' m.uid=a.uid')->where($where)->order('m.uid desc')
            ->paginate([
                'list_rows' => 20,
                'query' => [
                    'group_id' => $group_id
                ],
            ], false);
        // 获取分页显示
        $pager = $list->render();
        View::assign('pager', $pager);
        // 转数组
        $list = $list->toArray()['data'];
        // 更改状态值
        int_to_string($list);
        View::assign('_list', $list);

        $this->setTitle('User Authorization');
        return View::fetch();
    }

    /**
     * 将用户从用户组中移除  入参:uid,group_id
     */
    public function removeFromGroup()
    {
        $uid = input('uid');
        $gid = input('group_id');
        if ($uid == is_login()) {
            return $this->error('Cannot remove yourself');
        }
        if (empty($uid) || empty($gid)) {
            return $this->error('Parameter Error');
        }
        $AuthGroup = new AuthGroup();

        if (!$AuthGroup->find($gid)) {
            return $this->error('The user group does not exist');
        }
        if ($AuthGroup->removeFromGroup($uid, $gid)) {
            return $this->success('Success');
        } else {
            return $this->error('Failed');
        }
    }

    /**
     * 访问授权页面
     */
    public function access()
    {
        $this->setTitle('Admin Permissions');
        $group_id = input('group_id', 0, 'intval');
        $group = Db::name('AuthGroup')->find($group_id);
        View::assign('this_group', $group);

        // 更新权限菜单
        $this->updateRules();
        // 权限节点
        $node_list = $this->returnNodes();
        View::assign('node_list', $node_list);

        // 用户权限组
        $auth_group = Db::name('AuthGroup')->where(['status' => 1, 'module' => 'admin', 'type' => AuthGroup::TYPE_ADMIN])->field('id,title,rules')->select()->toArray();
        View::assign('auth_group', $auth_group);

        $map = ['module' => 'admin', 'type' => AuthRule::RULE_MAIN, 'status' => 1];
        $main_rules = Db::name('AuthRule')->where($map)->column('id', 'name');
        View::assign('main_rules', $main_rules);

        $map = ['module' => 'admin', 'type' => AuthRule::RULE_URL, 'status' => 1];
        $child_rules = Db::name('AuthRule')->where($map)->column('id', 'name');
        View::assign('auth_rules', $child_rules);

        return View::fetch();
    }

    /**
     * 后台节点配置的url作为规则存入auth_rule
     * 执行新节点的插入,已有节点的更新,无效规则的删除三项任务
     */
    public function updateRules()
    {
        //需要新增的节点必然位于$nodes
        $nodes = $this->returnNodes(false);

        $AuthRule = new AuthRule();
        //status全部取出,以进行更新
        $map = [['module', '=', 'admin'], ['type', 'in', '1,2']];
        //需要更新和删除的节点必然位于$rules
        $rules = $AuthRule->where($map)->order('name')->select()->toArray();
        //构建insert数据
        $data = []; //保存需要插入和更新的新节点
        foreach ($nodes as $value) {
            $temp['name'] = $value['url'];
            $temp['title'] = $value['title'];
            $temp['module'] = 'admin';
            if ($value['pid'] > 0 || $value['pid'] !== '0') {
                $temp['type'] = AuthRule::RULE_URL;
            } else {
                $temp['type'] = AuthRule::RULE_MAIN;
            }
            $temp['status'] = 1;
            $data[strtolower($temp['name'] . $temp['module'] . $temp['type'])] = $temp; //去除重复项
        }
        $update = []; //保存需要更新的节点
        $ids = []; //保存需要删除的节点的id
        foreach ($rules as $index => $rule) {
            $key = strtolower($rule['name'] . $rule['module'] . $rule['type']);
            if (isset($data[$key])) { //如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
                $data[$key]['id'] = $rule['id']; //为需要更新的节点补充id值
                $update[] = $data[$key];
                unset($data[$key]);
                unset($rules[$index]);
                unset($rule['condition']);
                $diff[$rule['id']] = $rule;
            } elseif ($rule['status'] == 1) {
                $ids[] = $rule['id'];
            }
        }
        if (count($update)) {
            foreach ($update as $k => $row) {
                if ($row != $diff[$row['id']]) {
                    $AuthRule->where(['id' => $row['id']])->update($row);
                }
            }
        }

        if (count($ids)) {
            $AuthRule->where('id', 'in', implode(',', $ids))->update(['status' => -1]);
            //删除规则是否需要从每个用户组的访问授权表中移除该规则?
        }

        if (count($data)) {
            $AuthRule->insertAll(array_values($data));
        }
        return true;
    }


    /**
     * 返回后台节点数据
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     * @author 大蒙<59262424@qq.com> 更新
     */
    protected function returnNodes($tree = true)
    {
        static $tree_nodes = [];

        if ($tree && !empty($tree_nodes[(int)$tree])) {
            return $tree_nodes[$tree];
        }
        if ($tree) {
            $list = Db::name('menu')->field('id,pid,title,url,tip,hide,module')->order('module asc, sort asc')->select()->toArray();
            foreach ($list as &$value) {
                $value = $this->check_url_re($value);
                unset($value['module']);
            }
            unset($value);

            //由于menu表id更改为字符串格式，root必须设置成字符串0
            $nodes = list_to_tree($list, 'id', 'pid', 'operator', '0');

            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            $nodes = Db::name('menu')->field('title,url,tip,pid,module')->order('sort asc')->select()->toArray();
            foreach ($nodes as &$value) {
                $value = $this->check_url_re($value);
                unset($value['module']);
            }
            unset($value);
        }

        $tree_nodes[(int)$tree] = $nodes;

        return $nodes;
    }

    public function check_url_re($value = [])
    {

        if (empty($value['module']) || $value['module'] == '') {
            if (stripos($value['url'], app('http')->getName()) !== 0) {
                $value['url'] = app('http')->getName() . '/' . $value['url'];
            }
        }

        return $value;
    }
}
