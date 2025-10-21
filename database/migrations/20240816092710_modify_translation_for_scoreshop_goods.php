<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ModifyTranslationForScoreshopGoods extends Migrator
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
      ->renameColumn('title_in_english', 'title_zh')
      ->renameColumn('title_in_hindi', 'title_hi')
      ->renameColumn('title_in_indonesia', 'title_id')
      ->renameColumn('title_in_japan', 'title_ja')
      ->renameColumn('title_in_thai', 'title_th')
      ->renameColumn('title_in_vietnamese', 'title_vi')
      ->renameColumn('title_in_melayu', 'title_ms')
      ->addColumn('title_ar', 'text', ['null' => true])
      ->renameColumn('description_in_english', 'description_zh')
      ->renameColumn('description_in_hindi', 'description_hi')
      ->renameColumn('description_in_indonesia', 'description_id')
      ->renameColumn('description_in_japan', 'description_ja')
      ->renameColumn('description_in_thai', 'description_th')
      ->renameColumn('description_in_vietnamese', 'description_vi')
      ->renameColumn('description_in_melayu', 'description_ms')
      ->addColumn('description_ar', 'text', ['null' => true])
      ->renameColumn('content_in_english', 'content_zh')
      ->renameColumn('content_in_hindi', 'content_hi')
      ->renameColumn('content_in_indonesia', 'content_id')
      ->renameColumn('content_in_japan', 'content_ja')
      ->renameColumn('content_in_thai', 'content_th')
      ->renameColumn('content_in_vietnamese', 'content_vi')
      ->renameColumn('content_in_melayu', 'content_ms')
      ->addColumn('content_ar', 'text', ['null' => true])
      ->update();
  }

  public function down()
  {
    $table = $this->table('scoreshop_goods');

    $table
      ->renameColumn('title_zh', 'title_in_english')
      ->renameColumn('title_hi', 'title_in_hindi')
      ->renameColumn('title_id', 'title_in_indonesia')
      ->renameColumn('title_ja', 'title_in_japan')
      ->renameColumn('title_th', 'title_in_thai')
      ->renameColumn('title_vi', 'title_in_vietnamese')
      ->renameColumn('title_ms', 'title_in_melayu')
      ->removeColumn('title_ar')
      ->renameColumn('description_zh', 'description_in_english')
      ->renameColumn('description_hi', 'description_in_hindi')
      ->renameColumn('description_id', 'description_in_indonesia')
      ->renameColumn('description_ja', 'description_in_japan')
      ->renameColumn('description_th', 'description_in_thai')
      ->renameColumn('description_vi', 'description_in_vietnamese')
      ->renameColumn('description_ms', 'description_in_melayu')
      ->removeColumn('description_ar')
      ->renameColumn('content_zh', 'content_in_english')
      ->renameColumn('content_hi', 'content_in_hindi')
      ->renameColumn('content_id', 'content_in_indonesia')
      ->renameColumn('content_ja', 'content_in_japan')
      ->renameColumn('content_th', 'content_in_thai')
      ->renameColumn('content_vi', 'content_in_vietnamese')
      ->renameColumn('content_ms', 'content_in_melayu')
      ->removeColumn('content_ar')
      ->update();
  }
}
