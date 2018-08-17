<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_reports')->insert([
            'id' => 2,
            'name' => 'Estadístico'
        ]);
        DB::table('category_reports')->insert([
            'id' => 3,
            'name' => 'Financiero'
        ]);
        DB::table('category_reports')->insert([
            'id' => 4,
            'name' => 'Gestión'
        ]);
        DB::table('category_reports')->insert([
            'id' => 5,
            'name' => 'Fondo de ley'
        ]);
    }
}
