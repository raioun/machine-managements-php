<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      [
        'name' => '山澤　潤',
        'password' => 'yamazawa',
        'status' => '0',
      ],
      
      [
        'name' => '宮下　徹',
        'password' => 'miyashita',
        'status' => '0',
      ],
      
      [
        'name' => '木村　光代',
        'password' => 'kimura',
        'status' => '1',
      ],
    ]);
  }
}
