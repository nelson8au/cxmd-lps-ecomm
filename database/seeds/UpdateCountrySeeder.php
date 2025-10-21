<?php

use think\facade\Db;
use think\facade\Log;
use think\migration\Seeder;

class UpdateCountrySeeder extends Seeder
{
  /**
   * Run Method.
   *
   * Write your database seeder using this method.
   *
   * More information on writing seeders is available here:
   * http://docs.phinx.org/en/latest/seeding.html
   */
  public function run(): void
  {
    Db::execute('TRUNCATE TABLE muucmf_district;');

    $csvFilePath = root_path() . 'database/data/countries_provinces.csv';

    $nameIndex = 0;
    $levelIndex = 1;
    $parentIndex = 2;

    $isFirstLine = true;

    // Open the CSV file for reading
    if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
      // Process the remaining rows
      while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (!$isFirstLine) {
          $record = Db::table('muucmf_district')->where('name', $row[$nameIndex])->find();
          if (!$record) {
            if ($row[$parentIndex] !== '0') {
              $parent = Db::table('muucmf_district')->where('name', $row[$parentIndex])->find();
              $parentId = $parent['id'];
            } else {
              $parentId = 0;
            }
            Db::table('muucmf_district')->insert([
              'name' => $row[$nameIndex],
              'level' => $row[$levelIndex],
              'upid' => $parentId,
            ]);
            Log::info('Created record in districts: ' . $row[$nameIndex]);
          }
        }

        $isFirstLine = false;
      }
      // Close the CSV file
      fclose($handle);
    }
  }
}
