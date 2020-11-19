<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
   
   // 不要なデータ分のコメントアウトを忘れずに
  public function run()
  {
    $this->call(CustomersTableSeeder::class);
    $this->call(OrderersTableSeeder::class);
    $this->call(ProjectsTableSeeder::class);
    $this->call(CompaniesTableSeeder::class);
    $this->call(BranchesTableSeeder::class);
    $this->call(StoragesTableSeeder::class);
    $this->call(MachinesTableSeeder::class);
    $this->call(RentalMachinesTableSeeder::class);
    
    // ↓他のseederと切り離して使用
    // $this->call(OrdersTableSeeder::class);
    
    // ↓使用不可
    // $this->call(UsersTableSeeder::class);
  }
}
