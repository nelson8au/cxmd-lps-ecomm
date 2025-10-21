<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ModifyAddressTable extends Migrator
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
    $table = $this->table('address');

    $table->removeColumn('pos_city')
      ->removeColumn('pos_district')
      ->addColumn('pos_country', 'string', ['after' => 'address'])
      ->addColumn('phone_prefix', 'string', ['after' => 'name'])
      ->addColumn('postcode', 'string', ['after' => 'pos_province'])
      ->update();
  }

  public function down()
  {
    $table = $this->table('address');

    $table->addColumn('pos_city', 'string')
      ->addColumn('pos_district', 'string')
      ->removeColumn('pos_country')
      ->removeColumn('phone_prefix')
      ->removeColumn('postcode')
      ->update();
  }
}
