<?php

use Illuminate\Database\Seeder;

class OrderersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('orderers')->insert([
      [
        'customer_id' => '1',
        'family_name' => '佐藤',
        'first_name' => '太郎',
        'phone_number' => '012-3456-7890',
        'status' => '0',
      ],
      
      [
        'customer_id' => '2',
        'family_name' => '田中',
        'first_name' => '次郎',
        'phone_number' => '090-2222-4444',
        'status' => '0',
      ],
      
      [
        'customer_id' => '3',
        'family_name' => '加藤',
        'first_name' => '三郎',
        'phone_number' => '080-3333-5555',
        'status' => '0',
      ],

    ]);
  }
}
