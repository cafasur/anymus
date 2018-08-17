<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            'application_id' => 1,
            'title' => 'Crear usuario',
            'icon' => 'fa-user-plus',
            'route' => 'users.create',
            'order' => '1'
        ]);
        DB::table('menu_items')->insert([
            'application_id' => 2,
            'title' => 'Crear Rol',
            'icon' => 'fa-user-plus',
            'route' => 'roles.create',
            'order' => '1'
        ]);
        DB::table('menu_items')->insert([
            'application_id' => 2,
            'title' => 'Asignar Rol',
            'icon' => 'fa-user-shield',
            'route' => 'roles.assign_role',
            'order' => '2'
        ]);
        DB::table('menu_items')->insert([
            'application_id' => 3,
            'title' => 'Formato informes SSF',
            'icon' => 'fa-file-signature',
            'route' => 'formalities.form_ssf',
            'order' => '1'
        ]);
        DB::table('menu_items')->insert([
            'application_id' => 3,
            'title' => 'Formato ausentismo',
            'icon' => 'fa-file-contract',
            'route' => 'formalities.form_absenteeism',
            'order' => '2'
        ]);
        DB::table('menu_items')->insert([
            'application_id' => 3,
            'title' => 'Gestión de permisos',
            'icon' => 'fa-users',
            'route' => 'formalities.permission_management',
            'order' => '3'
        ]);

    }
}
