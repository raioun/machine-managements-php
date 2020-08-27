<?php

use Illuminate\Database\Seeder;

class RentalMachinesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('rental_machines')->insert([
      [
        'machine_id' => '1',
        'branch_id' => '1',
        'storage_id' => '1',
        'code' => '1',
        'status' => '0',
        'remarks' => '',
      ],
      
      [
        'machine_id' => '2',
        'branch_id' => '2',
        'storage_id' => '3',
        'code' => '101',
        'status' => '2',
        'remarks' => '2020年1月15日廃棄申請済み',
      ],
      
      [
        'machine_id' => '3',
        'branch_id' => '3',
        'storage_id' => '2',
        'code' => '06',
        'status' => '1',
        'remarks' => 'オイル漏れありのため、出庫不可。整備期間は3ヶ月を要する見込み',
      ],
    ]);
  }
}
