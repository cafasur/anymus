<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsenteeismTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absenteeism_types')->insert([
           'name' => 'Diligencia Personal'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Compensatorio'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Cita medica'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Representación de la empresa'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Incapacidad medica'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Calamidad domestica'
        ]);
        DB::table('absenteeism_types')->insert([
            'name' => 'Otro'
        ]);
    }
}
