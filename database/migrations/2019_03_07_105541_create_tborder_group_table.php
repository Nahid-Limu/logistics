<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTborderGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tborder_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('selsGroupId',30)->index()->nullable();
            $table->integer('order_employee_id')->index()->nullable();
            $table->tinyInteger('sorting_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tborder_group');
    }
}
