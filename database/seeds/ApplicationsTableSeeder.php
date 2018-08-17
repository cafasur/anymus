<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            'name' => 'Usuarios',
            'icon' => 'fa-users-cog',
            'name_route' => 'users.index',
        ]);
        DB::table('applications')->insert([
                'name' => 'Roles',
            'icon' => 'fa-user-shield',
            'name_route' => 'roles.index',
        ]);
        DB::table('applications')->insert([
            'name' => 'Trámites',
            'icon' => 'fa-file-invoice',
            'name_route' => 'formalities.index',
        ]);
    }
}
