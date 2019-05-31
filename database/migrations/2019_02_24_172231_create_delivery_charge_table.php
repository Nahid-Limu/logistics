<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_charge', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendorId')->index();
            $table->integer('dimensionId')->nullable()->index();
            $table->decimal('price',18,2)->nullable();
            $table->tinyInteger('createdBy');
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
        Schema::dropIfExists('delivery_charge');
    }
}
