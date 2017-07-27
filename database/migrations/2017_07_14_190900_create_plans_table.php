<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->decimal('pre',11,2)->nullable();
            $table->decimal('price',11,2)->nullable();
            $table->decimal('post',11,2)->nullable();
            $table->decimal('cancel',11,2)->nullable();
            $table->boolean('hourly')->default(false);
            $table->boolean('daily')->default(false);
            $table->boolean('weekly')->default(false);
            $table->boolean('monthly')->default(false);
            $table->boolean('yearly')->default(false);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('plans');
    }
}
