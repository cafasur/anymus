<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'document_type_id' => 1,
            'document' => '1105675982',
            'email' => 'sistemas@cafasur.com.co',
            'status_id' => 1,
            'unit_id' => 1
        ]);
        DB::table('users')->insert([
            'document_type_id' => 1,
            'document' => '1105687909',
            'email' => 'estadistica@cafasur.com.co',
            'status_id' => 1,
            'unit_id' => 1
        ]);
    }
}
