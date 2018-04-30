<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id',false,true);
            $table->integer('role_id',false,true);
            $table->boolean('allowed');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_applications', function(Blueprint $table) {
            $table->dropForeign('permission_applications_application_id_foreign');
            $table->dropForeign('permission_applications_role_id_foreign');
        });
        Schema::dropIfExists('permission_applications');
    }
}
