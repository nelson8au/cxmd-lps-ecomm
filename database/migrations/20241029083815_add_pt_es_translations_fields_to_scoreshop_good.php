<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AddPtEsTranslationsFieldsToScoreshopGood extends Migrator
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
    $table = $this->table('scoreshop_goods');

    $table
      ->addColumn('title_pt', 'text', ['null' => true])
      ->addColumn('title_es', 'text', ['null' => true])
      ->addColumn('description_pt', 'text', ['null' => true])
      ->addColumn('description_es', 'text', ['null' => true])
      ->addColumn('content_pt', 'text', ['null' => true])
      ->addColumn('content_es', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('scoreshop_goods');

    $table
      ->removeColumn('title_pt')
      ->removeColumn('title_es')
      ->removeColumn('description_pt')
      ->removeColumn('description_es')
      ->removeColumn('content_pt')
      ->removeColumn('content_es')
      ->update();
  }
}
