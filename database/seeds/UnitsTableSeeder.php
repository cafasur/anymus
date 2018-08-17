<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'unit' => 'Sistemas'
        ]);
        DB::table('units')->insert([
            'unit' => 'Administración'
        ]);
        DB::table('units')->insert([
            'unit' => 'Financiera'
        ]);
        DB::table('units')->insert([
            'unit' => 'Aportes y Subsidios'
        ]);
        DB::table('units')->insert([
            'unit' => 'Recreación, Deportes y Turismo'
        ]);
        DB::table('units')->insert([
            'unit' => 'Vivienda'
        ]);
        DB::table('units')->insert([
            'unit' => 'Crédito'
        ]);
        DB::table('units')->insert([
            'unit' => 'Centro de Empleo'
        ]);
        DB::table('units')->insert([
            'unit' => 'Colegio Cafasur'
        ]);
        DB::table('units')->insert([
            'unit' => 'Educación y Cultura'
        ]);
    }
}
