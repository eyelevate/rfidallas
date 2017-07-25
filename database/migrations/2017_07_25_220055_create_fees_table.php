<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->decimal('pretax',11,2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pre_fee_plan', function (Blueprint $table) { // Used for pre plan fees
            $table->integer('fee_id');
            $table->integer('plan_id');
            $table->primary(['fee_id','plan_id']);
        });

        Schema::create('post_fee_plan', function (Blueprint $table) { // Used for post plan fees
            $table->integer('fee_id');
            $table->integer('plan_id');
            $table->primary(['fee_id','plan_id']);
        });

        Schema::create('cancel_fee_plan', function (Blueprint $table) { // Used for post plan fees
            $table->integer('fee_id');
            $table->integer('plan_id');
            $table->primary(['fee_id','plan_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        
        Schema::dropIfExists('fees');

        Schema::dropIfExists('pre_fee_plan');
        Schema::dropIfExists('post_fee_plan');
        Schema::dropIfExists('cancel_fee_plan');
    }
}

