<?php

namespace app\admin\controller;

use think\Exception;
use app\admin\lib\Upgrade as UpgradeServer;
use app\admin\lib\Cloud as CloudServer;
use think\facade\Db;
use think\facade\View;
use app\common\service\Tree;
use app\admin\model\Menu as MenuModel;
use app\common\model\Module as ModuleModel;


class Module extends Admin
{
    protected $MenuModel;
    protected $ModuleModel;

    /**
     * 构造方法
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->MenuModel = new MenuModel();
        $this->ModuleModel = new ModuleModel();
    }

    /**
     * 模块管理列表首页
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index()
    {
        $this->setTitle('Module Management');

        $aType = input('type', 'installed', 'text');
        View::assign('type', $aType);

        switch ($aType) {
            case 'all':
                $map = [];
                $this->ModuleModel->reload();
                break;
                // 已安装
            case 'installed':
                $map[] = ['is_setup', '=', 1];
                break;
                // 未安装
            case 'uninstalled':
                $map[] = ['is_setup', '=', 0];
                $this->ModuleModel->reload();
                break;
        };

        $upgradeServer = new UpgradeServer();
        $modules = $this->ModuleModel->getListByPage($map, 'sort desc,id desc', '*', 15);
        $cloud = new CloudServer();
        foreach ($modules as &$item) {
            // 云端应用数据处理
            if ($item['source'] == 'cloud') {
                $result = $upgradeServer->cloudVersion([
                    'app_name' => $item['name'],
                    'appid'    => $item['appid']
                ]);
                $item['new_version'] = isset($result['data']['version']) ? $result['data']['version'] : $item['version'];
                $item['upgrade'] = get_upgrade_status($item['version'], $item['new_version']) ? 1 : 0;

                $item['expired'] = 0;
                $auth = $cloud->needAuthorization($item['name']);
                if (is_array($auth) && $auth['code'] == 0 && $auth['data'] == 'end_auth') {
                    $item['expired'] = 1;
                }
            }
            // 本地应用数据处理
            if ($item['source'] == 'local') {
                // 获取文件配置信息
                $info = $this->ModuleModel->getModule($item['name']);
            }

            //获取应用图标
            if (empty($item['icon'])) {
                //图标所在位置为模块静态目录下（推荐）
                if (file_exists(PUBLIC_PATH . '/static/' . $item['name'] . '/images/icon.png')) {
                    $item['icon_100'] = $item['icon_200'] = $item['icon_300'] = $item['icon_400'] = '/static/' . $item['name'] . '/images/icon.png';
                } else {
                    $item['icon_100'] = $item['icon_200'] = $item['icon_300'] = $item['icon_400'] = '/static/admin/images/module_default_icon.png';
                }
            } else {
                $width = 100;
                $height = 100;
                $item['icon_100'] = get_thumb_image($item['icon'], intval($width), intval($height));
                $item['icon_200'] = get_thumb_image($item['icon'], intval($width * 2), intval($height * 2));
                $item['icon_300'] = get_thumb_image($item['icon'], intval($width * 3), intval($height * 3));
                $item['icon_400'] = get_thumb_image($item['icon'], intval($width * 4), intval($height * 4));

                if (strpos($item['icon'], 'https://') !== false && file_exists(PUBLIC_PATH . '/static/' . $item['name'] . '/images/icon.png')) {
                    //图标所在位置为模块静态目录下（推荐）
                    $item['icon_100'] = $item['icon_200'] = $item['icon_300'] = $item['icon_400'] = '/static/' . $item['name'] . '/images/icon.png';
                }
            }
        }
        unset($item);

        $page = htmlspecialchars_decode($modules->render());
        View::assign('page', $page);
        View::assign('modules', $modules);
        // 记录当前列表页的cookie
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        // 输出页面
        return View::fetch();
    }

    /**
     * 编辑模块数据
     */
    public function edit()
    {
        $id = input('id', 0, 'intval');
        $title = $id ? "Edit" : "Add";
        if (request()->isPost()) {
            $data = input();

            $res = $this->ModuleModel->edit($data);
            if ($res) {
                return $this->success($title . 'Success', $res, cookie('__forward__'));
            } else {
                return $this->error($title . 'Failed');
            }
        }

        if (!empty($id)) {
            $data = $this->ModuleModel->getDataById($id);
        }
        View::assign('data', $data);

        return View::fetch();
    }

    /**
     * 获取云端最新版本
     */
    public function cv()
    {
        $name = input('name', '', 'text');
        $module = $this->ModuleModel->getModule($name, 'name, version, is_setup, source');
        if (!empty($module)) {
            $upgradeServer = new UpgradeServer();
            $cloud = new CloudServer();
            if ($module['source'] == 'cloud') {
                //获取云端版本
                $result = $upgradeServer->cloudVersion(['app_name' => $module['name']]);
                $module['cloud_version'] = isset($result['data']['version']) ? $result['data']['version'] : $module['version'];
                $module['upgrade'] = get_upgrade_status($module['version'], $module['cloud_version']) ? 1 : 0;
                $module['remark'] = isset($result['data']['remark']) ? $result['data']['remark'] : '';
                $module['expired'] = 0;
                $auth = $cloud->needAuthorization($module['name']);
                if (is_array($auth) && $auth['code'] == 0 && $auth['data'] == 'end_auth') {
                    $module['expired'] = 1;
                }
            }

            return $this->success('success', $module);
        } else {
            return $this->error('Module does not exist');
        }
    }

    /**
     * 安装模块
     * @return [type] [description]
     */
    public function install()
    {
        $aName = input('name', '', 'text');
        $module = $this->ModuleModel->getModule($aName);

        if (request()->isPost()) {
            //执行guide中的内容
            try {
                $res = $this->ModuleModel->install($aName);

                if ($res === true) {
                    return $this->success('Installation Successful.', '', cookie('__forward__'));
                }
            } catch (Exception $e) {
                return $this->error($e->getMessage());
            }
        } else {
            View::assign('module', $module);
            return View::fetch();
        }
    }

    /**
     * 卸载模块
     */
    public function uninstall()
    {
        $id = input('id', 0, 'intval');
        $module = $this->ModuleModel->where('id', $id)->find();

        if (request()->isPost()) {
            $aWithoutData = input('withoutData', 1, 'intval'); //是否保留数据
            $res = $this->ModuleModel->uninstall($id, $aWithoutData);

            if ($res == true) {
                //删除菜单
                Db::name('menu')->where(['module' => $module['name']])->delete();
                //删除module表中记录
                $this->ModuleModel->where(['id' => $id])->delete();
                return $this->success('Module uninstalled successfully.', '', cookie('__forward__'));
            } else {
                return $this->error('Module uninstallation failed.');
            }
        } else {
            View::assign('module', $module);
            return View::fetch();
        }
    }


    /**
     * 应用权限菜单首页
     * @return none
     */
    public function menu()
    {
        $app = input('app', '', 'text');
        View::assign('app', $app);
        $title = input('title', '', 'text');
        $pid  = input('pid', '0', 'text');
        View::assign('pid', $pid);
        $map = [];

        $list_map = [];
        if (!empty($app)) {
            //获取上级数据
            $map['name'] = $app;
            $data = $this->ModuleModel->where($map)->find();
            View::assign('data', $data);
            $list_map[] = ['module', '=', $app];
        }

        if (!empty($title)) {
            $list_map['title'] = ['like', '%' . $title . '%'];
        }

        $list = $this->MenuModel->where($list_map)->order('sort asc')->select()->toArray();
        foreach ($list as &$val) {
            $val = $this->MenuModel->handle($val);
        }
        unset($val);
        // 转树结构
        $list = list_to_tree($list, 'id', 'pid', '_child', $pid);
        View::assign('list', $list);

        // 记录当前列表页的cookie
        Cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->setTitle('Admin Panel Menu Management');

        return View::fetch();
    }

    /**
     * 新增/编辑应用权限菜单
     */
    public function medit()
    {

        if (request()->isPost()) {
            $data = input('');
            if ($data['title'] == '') {
                return $this->error('Menu title cannot be empty');
            }
            if ($data['url'] == '') {
                return $this->error('Menu url cannot be empty');
            }

            $res = $this->MenuModel->edit($data);
            if ($res) {
                //记录行为
                action_log('update_menu', 'Menu', $data['id'], is_login());
                return $this->success('Save Successful', $res, cookie('__forward__'));
            } else {
                return $this->error('Save Failed');
            }
        } else {
            $id = input('id', '0', 'text');
            // 上级ID
            $pid = input('pid', '0', 'text');
            View::assign('pid', $pid);
            // 应用唯一标识
            $app = input('app', '', 'text');
            View::assign('app', $app);
            // 初始化info数据
            $info = [
                'pid' => 0,
                'type' => 1,
            ];
            /* 获取数据 */
            if (!empty($id) || $id != '0') {
                $info = $this->MenuModel->where(['id' => $id])->find();
            }

            if (empty($info)) {
                $map['id'] = input('pid');
                $info = $this->MenuModel->where($map)->field('module,pid,hide,type')->find();
                $info['pid'] = input('pid', '0', 'text');
            }
            View::assign('info', $info);
            $menus = $this->MenuModel->where('module', '=', $app)->order('sort asc,id asc')->select()->toArray();
            $tree = new Tree();
            $menus = $tree->toFormatTree($menus, $title = 'title', $pk = 'id', $pid = 'pid', $root = '0');
            View::assign('Menus', $menus);

            $moduleModel = new ModuleModel();
            View::assign('Modules', $moduleModel->getAll());

            $this->setTitle('Edit Menu');

            return View::fetch();
        }
    }

    /**
     * 菜单删除
     */
    public function mdel()
    {
        $ids = input('ids/a');
        !is_array($ids) && $ids = explode(',', $ids);

        $res = $this->MenuModel->where('id', 'in', $ids)->delete();
        if ($res) {
            return $this->success('Deleted Successfully');
        } else {
            return $this->error('Deletion Failed');
        }
    }
}
