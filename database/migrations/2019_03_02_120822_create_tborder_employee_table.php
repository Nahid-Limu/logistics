<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTborderEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tborder_employee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId')->index();
            $table->integer('employeeId')->index();
            $table->tinyInteger('assignedBy')->index();
            $table->tinyInteger('status')->index();
            $table->integer('km')->index();
            $table->tinyInteger('k_status')->default('0');
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
        Schema::dropIfExists('tborder_employee');
    }
}
