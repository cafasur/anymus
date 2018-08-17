<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
           'name' => 'Céduda de cuidadania'
        ]);
        DB::table('document_types')->insert([
            'name' => 'Cédula de extranjeria'
        ]);
        DB::table('document_types')->insert([
            'name' => 'Tarjeta de identidad'
        ]);
    }
}
