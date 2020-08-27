<?php

use Illuminate\Database\Seeder;

class StoragesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('storages')->insert([
      [
        'company_id' => '1',
        'name' => '東京営業所',
        'address' => '千葉県白井市冨塚1',
      ],
      
      [
        'company_id' => '2',
        'name' => '千葉機材センター',
        'address' => '千葉県千葉市花見川区瑞穂一丁目1番地',
      ],
      
      [
        'company_id' => '3',
        'name' => '佐倉機材センター',
        'address' => '千葉県佐倉市海隣寺町97番地',
      ],
    ]);
  }
}
