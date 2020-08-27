<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('orders')->insert([
      [
        'out_date' => '2020-08-01',
        'out_time' => '',
        'in_date' => '2020-09-30',
        'in_time' => '',
        'status' => '0',
        'project_id' => '1',
        'orderer_id' => '1',
        'rental_machine_id' => '1',
        'user_id' => '1',
        'remarks' => '',
      ],
      
      [
        'out_date' => '2020-07-01',
        'out_time' => '',
        'in_date' => '2020-11-15',
        'in_time' => '',
        'status' => '1',
        'project_id' => '2',
        'orderer_id' => '2',
        'rental_machine_id' => '2',
        'user_id' => '2',
        'remarks' => '',
      ],
      
      [
        'out_date' => '2019-11-01',
        'out_time' => '',
        'in_date' => '2019-12-15',
        'in_time' => '',
        'status' => '2',
        'project_id' => '3',
        'orderer_id' => '3',
        'rental_machine_id' => '3',
        'user_id' => '3',
        'remarks' => '11月末返却予定→12月中旬に延期',
      ],

    ]);
  }
}
