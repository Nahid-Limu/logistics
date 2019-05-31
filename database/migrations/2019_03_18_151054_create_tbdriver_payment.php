<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbdriverPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbdriver_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('driverId')->nullable();
            $table->string('creditAmount',15)->nullable();
            $table->string('debitAmount',15)->nullable();
            $table->date('paymentDate',15)->nullable();
            $table->string('paymentBy',15)->nullable();
            $table->text('remarks')->nullable();
            $table->string('paymentMethod',2)->nullable();
            $table->string('paymentRemarks',100)->nullable();
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
        Schema::dropIfExists('tbdriver_payment');
    }
}
