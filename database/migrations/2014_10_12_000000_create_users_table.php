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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            /**
            * User Types
            * 1 - Superadmin
            * 2 - Admin
            * 3 - Employee
            * 4 - Member
            **/
            $table->tinyInteger('role_id')->default(4);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('company_user', function (Blueprint $table){
            $table->integer('company_id');
            $table->integer('user_id');
            $table->primary(['company_id','user_id']);
        });

        Schema::create('store_user', function (Blueprint $table){
            $table->integer('store_id');
            $table->integer('user_id');
            $table->primary(['store_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('store_user');
    }
}
