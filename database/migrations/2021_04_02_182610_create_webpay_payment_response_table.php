<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayPaymentResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpay_payment_response', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order', 50);
            $table->string('vci', 50);
            $table->integer('amount');
            $table->string('status', 50);
            $table->string('sessionId', 50);
            $table->string('cardDetail', 50);
            $table->string('cardDetail_card_number', 50);
            $table->string('accountingDate', 50);
            $table->dateTime('transactionDate');
            $table->string('authorizationCode', 50);
            $table->string('paymentTypeCode', 50);
            $table->string('responseCode', 50);
            $table->string('installmentsAmount', 50);
            $table->string('installmentsNumber', 50);
            $table->string('balance', 50);
            $table->unsignedBigInteger('purchase_attempt_id');
            $table->timestamps();

            $table->foreign('purchase_attempt_id')->references('id')->on('purchase_attempt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webpay_payment_response');
    }
}
