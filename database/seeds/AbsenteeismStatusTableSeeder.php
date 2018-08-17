<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsenteeismStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absenteeism_status')->insert([
            'name' => 'En espera'
        ]);
        DB::table('absenteeism_status')->insert([
            'name' => 'Rechazado'
        ]);
        DB::table('absenteeism_status')->insert([
            'name' => 'Aprobado'
        ]);
        DB::table('absenteeism_status')->insert([
            'name' => 'Finalizado'
        ]);
    }
}
