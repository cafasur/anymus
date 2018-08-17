<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodicitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodicities')->insert([
            'name' => 'Mensual',
        ]);
        DB::table('periodicities')->insert([
            'name' => 'Trimestral',
        ]);
        DB::table('periodicities')->insert([
            'name' => 'Semestral',
        ]);
        DB::table('periodicities')->insert([
            'name' => 'Anual',
        ]);
        DB::table('periodicities')->insert([
            'name' => 'Cuando suceda',
        ]);
    }
}
