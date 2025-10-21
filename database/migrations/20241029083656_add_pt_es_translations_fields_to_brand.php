<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AddPtEsTranslationsFieldsToBrand extends Migrator
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

    $table
      ->addColumn('name_pt', 'text', ['null' => true])
      ->addColumn('name_es', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('brand');

    $table
      ->removeColumn('name_pt')
      ->removeColumn('name_es')
      ->update();
  }
}
