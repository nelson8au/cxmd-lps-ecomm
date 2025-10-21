<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AddTranslationsToCategory extends Migrator
{
  /**
   * Change Method.
   *
   * Write your reversible migrations using this method.
   *
   * More information on writing migrations is available here:
   * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
   *
   * The following commands can be used in this method and Phinx will
   * automatically reverse them when rolling back:
   *
   *    createTable
   *    renameTable
   *    addColumn
   *    renameColumn
   *    addIndex
   *    addForeignKey
   *
   * Remember to call "create()" or "update()" and NOT "save()" when working
   * with the Table class.
   */
  public function up()
  {
    $table = $this->table('scoreshop_category');

    $table
      ->addColumn('title_ar', 'text', ['null' => true])
      ->addColumn('title_hi', 'text', ['null' => true])
      ->addColumn('title_id', 'text', ['null' => true])
      ->addColumn('title_ja', 'text', ['null' => true])
      ->addColumn('title_th', 'text', ['null' => true])
      ->addColumn('title_vi', 'text', ['null' => true])
      ->addColumn('title_ms', 'text', ['null' => true])
      ->addColumn('title_zh', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('scoreshop_category');

    $table
      ->removeColumn('title_ar')
      ->removeColumn('title_hi')
      ->removeColumn('title_id')
      ->removeColumn('title_ja')
      ->removeColumn('title_th')
      ->removeColumn('title_vi')
      ->removeColumn('title_ms')
      ->removeColumn('title_zh')
      ->update();
  }
}
