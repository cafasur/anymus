<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_account_google')->unique()->nullable();
            $table->integer('document_type_id',false,true);
            $table->integer('document',false,true);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->integer('status_id',false,true);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('user_status');
            $table->foreign('document_type_id')->references('id')->on('document_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   Schema::table('users', function (Blueprint $table){
            $table->dropForeign('users_status_id_foreign');
            $table->dropForeign('users_document_type_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}
