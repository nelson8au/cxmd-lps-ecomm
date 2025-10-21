<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateMarqueeTable extends Migrator
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
    $table = $this->table('marquee');

    $table->addColumn('content_en', 'text')
      ->addColumn('content_zh', 'text', ['null' => true])
      ->addColumn('content_hi', 'text', ['null' => true])
      ->addColumn('content_id', 'text', ['null' => true])
      ->addColumn('content_ja', 'text', ['null' => true])
      ->addColumn('content_th', 'text', ['null' => true])
      ->addColumn('content_vi', 'text', ['null' => true])
      ->addColumn('content_ms', 'text', ['null' => true])
      ->addColumn('content_ar', 'text', ['null' => true])
      ->addColumn('content_pt', 'text', ['null' => true])
      ->addColumn('content_es', 'text', ['null' => true])
      ->addColumn('url', 'text', ['default' => ''])
      ->addColumn('order', 'integer')
      ->addColumn('status', 'boolean')
      ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
      ->create();
  }

  public function down()
  {
    $table = $this->table('marquee');

    $table->drop()->save();
  }
}
