<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('plan_id')->nullable();
            $table->string('name');
            $table->string('nick_name');
            $table->string('street');
            $table->string('suite');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode');
            $table->string('phone');
            $table->string('phone_option')->nullable();
            $table->string('email');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_api_key')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('company_device', function (Blueprint $table){
            $table->integer('company_id');
            $table->integer('device_id');
            $table->primary(['company_id','device_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_device');
    }
}
