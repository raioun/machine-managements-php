<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('companies')->insert([
      [
        'name' => '株式会社中建サービス',
      ],
      [
        'name' => '株式会社所有',
      ],
      [
        'name' => '株式会社machine',
      ],
    ]);
  }
}
