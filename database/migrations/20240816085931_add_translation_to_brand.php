<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AddTranslationToBrand extends Migrator
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
    $table = $this->table('brand');

    $table->renameColumn('name', 'name_en')
      ->addColumn('name_ar', 'text', ['null' => true])
      ->addColumn('name_hi', 'text', ['null' => true])
      ->addColumn('name_id', 'text', ['null' => true])
      ->addColumn('name_ja', 'text', ['null' => true])
      ->addColumn('name_th', 'text', ['null' => true])
      ->addColumn('name_vi', 'text', ['null' => true])
      ->addColumn('name_ms', 'text', ['null' => true])
      ->addColumn('name_zh', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('brand');

    $table->renameColumn('name_en', 'name')
      ->removeColumn('name_ar')
      ->removeColumn('name_hi')
      ->removeColumn('name_id')
      ->removeColumn('name_ja')
      ->removeColumn('name_th')
      ->removeColumn('name_vi')
      ->removeColumn('name_ms')
      ->removeColumn('name_zh')
      ->update();
  }
}
