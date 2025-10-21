<?php

namespace app\common\Model;

use think\Model;
use think\facade\Db;

/**
 * 品牌模型
 */
class Brand extends Model
{
    /**
     * getBrandList  获取品牌列表
     * @param string $map
     * @return mixed
     */
    public function getBrandList($map)
    {
        $list = $this->where($map)->order('id asc')->select()->toArray();

        return $list;
    }

    /**
     * 获取品牌索引ID
     */
    public function getBrandListByIndex($map = []){
        $list = $this->where($map)->order('id asc')->select()->toArray();
        $array = [];
        foreach($list as $v)
        {
            $array[$v['id']] = $v;
        }
        return $array;
    }

    /**
     * getBrand  获取单个品牌
     * @param string $map
     * @return mixed
     */
    public function getBrand(array $map)
    {
        $type = $this->where($map)->find();
        return $type;
    }

    /**
     * addBrand 增加品牌
     * @param $data
     * @return mixed
     */
    public function addBrand($data)
    {
        $db_prefix = config('database.connections.mysql.prefix');
        $id = Db::name('brand')->insertGetId($data);
        // $query = "ALTER TABLE  `{$db_prefix}member` ADD  `score" . $id . "` DOUBLE NOT NULL COMMENT  '" . $data['title'] . "'";

        // Db::execute($query);

        return $id;
    }

    /**
     * delBrand  删除品牌
     * @param $ids
     * @return mixed
     */
    public function delBrand($ids)
    {
        $db_prefix = config('database.connections.mysql.prefix');
        $res = $this->where([
            ['id','in', $ids], 
        ])->delete();
        // foreach ($ids as $v) {
        //     if ($v > 4) {
        //         $query = "alter table `{$db_prefix}member` drop column score" . $v;
        //         Db::execute($query);
        //     }
        // }
        return $res;
    }

    /**
     * editBrand  修改品牌
     * @param $data
     * @return mixed
     */
    public function editBrand($data)
    {
        $db_prefix = config('database.connections.mysql.prefix');
        $res = $this->update($data);
        // $query = "alter table `{$db_prefix}member` modify column `score" . $data['id'] . "` FLOAT comment '" . $data['title'] . "';";
        // Db::execute($query);
        return $res;
    }
}