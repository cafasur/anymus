<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSignaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_signatures')->insert([
            'direccion' => 'X',
            'contador' => '-',
            'revisor' => '-',
        ]);
        DB::table('type_signatures')->insert([
            'direccion' => 'X',
            'contador' => 'X',
            'revisor' => '-',
        ]);
        DB::table('type_signatures')->insert([
            'direccion' => 'X',
            'contador' => 'X',
            'revisor' => 'X',
        ]);
        DB::table('type_signatures')->insert([
            'direccion' => '-',
            'contador' => '-',
            'revisor' => 'X',
        ]);
    }
}
