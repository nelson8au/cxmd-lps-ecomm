<?php

use app\common\model\Member;
use think\facade\Db;
use think\facade\Log;
use think\migration\Seeder;

class UpdateCrmUserIdSeeder2 extends Seeder
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
    $csvFilePath = root_path() . 'database/data/useridmappingV2.csv';

    $crmUserIdIndex = 0;
    $emailIndex = 1;

    $isFirstLine = true;

    // Open the CSV file for reading
    if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
      // Process the remaining rows
      while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (!$isFirstLine) {
          $member = Member::where('email', $row[$emailIndex])->find();
          if ($member) {
            Db::table('muucmf_member')->where('email', $row[$emailIndex])->update([
              'crm_user_id' => $row[$crmUserIdIndex],
            ]);
            Log::info('Updated member: ' . $row[$emailIndex]);
          } else {
            Log::error('Member not found: ' . $row[$emailIndex]);
          }
        }

        $isFirstLine = false;
      }
      // Close the CSV file
      fclose($handle);
    }
  }
}
