<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->decimal('hourly',11,2)->nullable();
            $table->decimal('daily',11,2)->nullable();
            $table->decimal('weekly',11,2)->nullable();
            $table->decimal('monthly',11,2)->nullable();
            $table->decimal('yearly',11,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('plan_service', function (Blueprint $table) {
            $table->integer('plan_id');
            $table->integer('service_id');
            $table->primary(['plan_id','service_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('plan_service');
    }
}
