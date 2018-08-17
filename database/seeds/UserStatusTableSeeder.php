<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert([
            'name' => 'Activo'
        ]);
        DB::table('user_status')->insert([
            'name' => 'Inactivo'
        ]);
    }
}
