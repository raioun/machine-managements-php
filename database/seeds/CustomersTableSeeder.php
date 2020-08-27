<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('customers')->insert([
      [
        'name' => '株式会社エンジニア',
      ],
      [
        'name' => '株式会社TechBoost',
      ],
      [
        'name' => '株式会社BrandingEngineer',
      ],
    ]);
  }
}
