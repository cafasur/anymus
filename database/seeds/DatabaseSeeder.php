<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             DocumentTypesTableSeeder::class,
             UserStatusTableSeeder::class,
             PeriodicitiesTableSeeder::class,
             CategoryReportsTableSeeder::class,
             ShippingPeriodsTableSeeder::class,
             UnitsTableSeeder::class,
             TypeSignaturesTableSeeder::class,
             ApplicationsTableSeeder::class,
             MenuItemsTableSeeder::class,
             AbsenteeismStatusTableSeeder::class,
             AbsenteeismTypesTableSeeder::class,
             UserTableSeeder::class,
         ]);
    }
}
