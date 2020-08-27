<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('projects')->insert([
      [
        'customer_id' => '1',
        'name' => '霞が関',
        'address' => '東京都千代田区霞が関1-1-1',
        'status' => '0',
      ],
      
      [
        'customer_id' => '2',
        'name' => '渋谷',
        'address' => '東京都渋谷区道元坂1-1-1',
        'status' => '0',
      ],
      
      [
        'customer_id' => '3',
        'name' => '白井',
        'address' => '千葉県白井市冨塚1',
        'status' => '0',
      ],
      
    ]);
  }
}
