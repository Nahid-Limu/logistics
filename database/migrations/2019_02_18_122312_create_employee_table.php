<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150)->index()->nullable();
            $table->string('phone',30)->index()->nullable();
            $table->string('selsEmployeeId',190)->index()->unique();
            $table->integer('zone_id')->index()->nullable();
            $table->integer('area_id')->index()->nullable();
            $table->string('email',150)->index()->unique();
            $table->tinyInteger('gender')->index()->nullable();
            $table->string('photo')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('cv')->nullable();
            $table->string('national_id',150)->nullable();
            $table->string('passport',150)->nullable();
            $table->text('criminal_status')->nullable();
            $table->string('fathers_name',150)->nullable();
            $table->string('mothers_name',150)->nullable();
            $table->string('tin_number',150)->nullable();
            $table->text('bank_account_details')->nullable();
            $table->string('emergency_name',150)->nullable();
            $table->string('emergency_phone',30)->nullable();
            $table->string('emergency_nid',150)->nullable();
            $table->text('emergency_address')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->index();
            $table->integer('created_by')->index()->nullable();
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
        Schema::dropIfExists('employee');
    }
}
