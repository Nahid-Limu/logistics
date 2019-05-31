<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivingInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id')->index();
            $table->string('driving_licence')->nullable();
            $table->string('reg_number')->nullable();
            $table->year('reg_year')->nullable();
            $table->string('reg_documents')->nullable();
            $table->string('bike_company','150')->nullable();
            $table->string('bike_model')->nullable();
            $table->string('fuel_consumption')->nullable();
            $table->integer('created_by',false)->nullable();
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
        Schema::dropIfExists('driving_info');
    }
}
