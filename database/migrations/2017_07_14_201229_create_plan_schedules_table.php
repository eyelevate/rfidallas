<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id');
            $table->integer('company_id');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('reason')->nullable();
            /* Status
            * 1 - Plan Active
            * 2 - Plan Suspended
            * 3 - Plan Cancelled
            */
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('plan_schedules');
    }
}
