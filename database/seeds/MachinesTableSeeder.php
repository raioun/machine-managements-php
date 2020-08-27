<?php

use Illuminate\Database\Seeder;

class MachinesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('machines')->insert([
      [
        'name' => 'スタンドパイプ',
        'type1' => 'φ2000',
        'type2' => '6m',
      ],
      [
        'name' => 'Ｗケーシング',
        'type1' => 'φ1000',
        'type2' => '1㏄',
      ],
      [
        'name' => '全周ジャッキ',
        'type1' => 'RT-150',
        'type2' => 'AⅡ',
      ],
    ]);
  }
}
