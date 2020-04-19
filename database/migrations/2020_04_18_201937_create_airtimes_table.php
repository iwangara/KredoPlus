<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtimes', function (Blueprint $table) {
            $table->id();
            $table->string('no_saf')->nullable(true);
            $table->string('no_air')->nullable(true);
            $table->integer('amount')->nullable(true);
            $table->string('MerchantRequestID')->nullable(true);
            $table->string('CheckoutRequestID')->nullable(true);
            $table->string('ResultCode')->nullable(true);
            $table->string('ResultDesc')->nullable(true);
            $table->string('MpesaReceiptNumber')->nullable(true);
            $table->string('TransactionDate')->nullable(true);
            $table->string('receiptno')->nullable(true);
            $table->string('operator')->nullable(true);
            $table->string('transactionId')->nullable(true);
            $table->integer('status')->nullable(true);
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
        Schema::dropIfExists('airtimes');
    }
}
