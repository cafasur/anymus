<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Enero'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Febrero'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Marzo'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Abril'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Mayo'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Junio'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Julio'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Agosto'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Septiembre'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Octubre'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Noviembre'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '1',
            'name' => 'Diciembre'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '2',
            'name' => 'Trimestre I'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '2',
            'name' => 'Trismestre II'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '2',
            'name' => 'Trismestre III'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '2',
            'name' => 'Trismestre IV'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '3',
            'name' => 'Semestre I'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '3',
            'name' => 'Semestre II'
        ]);
        DB::table('shipping_periods')->insert([
            'code' => '4',
            'name' => 'Anual'
        ]);
    }
}
