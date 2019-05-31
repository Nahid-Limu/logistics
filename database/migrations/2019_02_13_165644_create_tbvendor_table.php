<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbvendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbvendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('selsVendorId',30)->index();
            $table->integer('areaId')->nullable()->index();
            $table->integer('zoneId')->nullable()->index();
            $table->string('name',150);
            $table->string('phone',30);
            $table->string('photo',255)->nullable();
            $table->float('deliveryRate')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('authorizedName',50)->nullable();
            $table->string('authorizedPersonnel',50)->nullable();
            $table->string('mediumOfContact',50)->nullable();
            $table->string('contactInformation',100)->nullable();
            $table->text('lCContactDetails')->nullable();
            $table->string('registrationNumber',100)->nullable();
            $table->string('TINNumber',50)->nullable();
            $table->tinyInteger('createdBy');
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
        Schema::dropIfExists('tbvendor');
    }
}
