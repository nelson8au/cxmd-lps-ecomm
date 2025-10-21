<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AddTranslationToScoreshopGoods extends Migrator
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

    $table->addColumn('title_in_english', 'text', ['null' => true])
      ->addColumn('title_in_hindi', 'text', ['null' => true])
      ->addColumn('title_in_indonesia', 'text', ['null' => true])
      ->addColumn('title_in_japan', 'text', ['null' => true])
      ->addColumn('title_in_thai', 'text', ['null' => true])
      ->addColumn('title_in_vietnamese', 'text', ['null' => true])
      ->addColumn('title_in_melayu', 'text', ['null' => true])
      ->addColumn('description_in_english', 'text', ['null' => true])
      ->addColumn('description_in_hindi', 'text', ['null' => true])
      ->addColumn('description_in_indonesia', 'text', ['null' => true])
      ->addColumn('description_in_japan', 'text', ['null' => true])
      ->addColumn('description_in_thai', 'text', ['null' => true])
      ->addColumn('description_in_vietnamese', 'text', ['null' => true])
      ->addColumn('description_in_melayu', 'text', ['null' => true])
      ->addColumn('content_in_english', 'text', ['null' => true])
      ->addColumn('content_in_hindi', 'text', ['null' => true])
      ->addColumn('content_in_indonesia', 'text', ['null' => true])
      ->addColumn('content_in_japan', 'text', ['null' => true])
      ->addColumn('content_in_thai', 'text', ['null' => true])
      ->addColumn('content_in_vietnamese', 'text', ['null' => true])
      ->addColumn('content_in_melayu', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('scoreshop_goods');

    $table->removeColumn('title_in_english')
      ->removeColumn('title_in_hindi')
      ->removeColumn('title_in_indonesia')
      ->removeColumn('title_in_japan')
      ->removeColumn('title_in_thai')
      ->removeColumn('title_in_vietnamese')
      ->removeColumn('title_in_melayu')
      ->removeColumn('description_in_english')
      ->removeColumn('description_in_hindi')
      ->removeColumn('description_in_indonesia')
      ->removeColumn('description_in_japan')
      ->removeColumn('description_in_thai')
      ->removeColumn('description_in_vietnamese')
      ->removeColumn('description_in_melayu')
      ->removeColumn('content_in_english')
      ->removeColumn('content_in_hindi')
      ->removeColumn('content_in_indonesia')
      ->removeColumn('content_in_japan')
      ->removeColumn('content_in_thai')
      ->removeColumn('content_in_vietnamese')
      ->removeColumn('content_in_melayu')
      ->update();
  }
}
