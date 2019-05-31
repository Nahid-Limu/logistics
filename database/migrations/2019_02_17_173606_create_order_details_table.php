<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tborder_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('selsOrderId',30)->nullable()->index();
            $table->integer('vendorId')->nullable()->index();
            $table->integer('zoneId')->nullable()->index();
            $table->integer('pickupLocationId')->nullable()->index();
            $table->integer('destinationLocationId')->nullable()->index();
            $table->string('receiverName',150)->nullable();
            $table->string('receiverPhone',30)->nullable();
            $table->text('receiverAddress')->nullable();
            $table->string('productTitle',50)->nullable();
            $table->string('productDimension',30)->nullable();
            $table->string('productQuantity',30)->nullable();
            $table->float('productPrice')->nullable();
            $table->date('deliveryLimitDate')->nullable();
            $table->string('deliveryLimitTime',30)->nullable();
            $table->float('receivedAmount')->nullable();
            $table->string('paymentMethod',15)->nullable();
            $table->float('deliveryCharge')->nullable();
            $table->text('receivedVerification')->nullable();
            $table->string('receivedSignature',255)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('deliveryBy')->nullable();
            $table->text('feedback')->nullable();
            $table->string('reasonOfrejected')->nullable();
            $table->date('order_date')->nullable();
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
        Schema::dropIfExists('tborder_details');
    }
}
