<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id');
            $table->integer('vendor_id');
            $table->integer('company_id')->nullable();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->decimal('price',11,2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('user_id')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('asset_items');
    }
}
