<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nick_name');
            $table->string('street');
            $table->string('suite');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode');
            $table->string('phone');
            $table->string('contact_name');
            $table->string('contact_option')->nullable();
            $table->string('email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
