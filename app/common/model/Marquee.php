<?php

namespace app\common\Model;

use think\Model;
use think\facade\Db;

class Marquee extends Model
{
  /**
   * @param string $map
   * @return mixed
   */
  public function getMarqueeList($map)
  {
    $list = $this->where($map)->order('id asc')->select()->toArray();

    return $list;
  }

  public function getMarqueeListByIndex($map = [])
  {
    $list = $this->where($map)->order('id asc')->select()->toArray();
    $array = [];
    foreach ($list as $v) {
      $array[$v['id']] = $v;
    }
    return $array;
  }

  /**
   * @param string $map
   * @return mixed
   */
  public function getMarquee(array $map)
  {
    $type = $this->where($map)->find();
    return $type;
  }

  /**
   * @param $data
   * @return mixed
   */
  public function addMarquee($data)
  {
    $db_prefix = config('database.connections.mysql.prefix');
    $id = Db::name('marquee')->insertGetId($data);
    // $query = "ALTER TABLE  `{$db_prefix}member` ADD  `score" . $id . "` DOUBLE NOT NULL COMMENT  '" . $data['title'] . "'";

    // Db::execute($query);

    return $id;
  }

  /**
   * @param $ids
   * @return mixed
   */
  public function delMarquee($ids)
  {
    $db_prefix = config('database.connections.mysql.prefix');
    $res = $this->where([
      ['id', 'in', $ids],
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
   * @param $data
   * @return mixed
   */
  public function editMarquee($data)
  {
    $db_prefix = config('database.connections.mysql.prefix');
    $res = $this->update($data);
    // $query = "alter table `{$db_prefix}member` modify column `score" . $data['id'] . "` FLOAT comment '" . $data['title'] . "';";
    // Db::execute($query);
    return $res;
  }
}
