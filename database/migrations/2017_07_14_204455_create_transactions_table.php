<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('card_id');
            $table->string('payment_id');
            $table->decimal('tendered',11,2)->nullable();
            $table->dateTime('tendered_date')->nullable();
            $table->string('payment_type');
            $table->boolean('refunded')->default(false);
            $table->decimal('refund_amount',11,2)->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
