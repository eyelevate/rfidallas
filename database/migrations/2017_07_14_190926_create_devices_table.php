<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_id');
            $table->string('model');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->text('issue')->nullable();
            $table->decimal('price',11,2);
            $table->decimal('tax',11,2);
            $table->decimal('total',11,2);
            /*
            * Status:
            * 1 - Available
            * 2 - Deployed
            * 3 - Malfunctioned
            * 4 - Returned
            */ 
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
        Schema::dropIfExists('devices');
    }
}
