<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblocation', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('zoneId');
            $table->string('name',150);
            $table->string('latitude',25);
            $table->string('longitude',25);
            $table->text('remarks')->nullable();
            $table->tinyInteger('createdBy');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('tblocation');
    }
}
