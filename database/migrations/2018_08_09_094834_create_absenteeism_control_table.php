<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenteeismControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absenteeism_control', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',false,true);
            $table->integer('absenteeism_type_id',false,true);
            $table->date('date_permission');
            $table->time('departure_time');
            $table->date('arrival_date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('detail_permission');
            $table->integer('status_id',false,true);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('absenteeism_type_id')->references('id')->on('absenteeism_types');
            $table->foreign('status_id')->references('id')->on('absenteeism_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absenteeism_control', function (Blueprint $table){
            $table->dropForeign('absenteeism_control_user_id_foreign');
            $table->dropForeign('absenteeism_control_absenteeism_type_id_foreign');
            $table->dropForeign('absenteeism_control_status_id_foreign');
        });
        Schema::dropIfExists('absenteeism_control');
    }
}
