<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbofficeLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tboffice_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branchName',150)->nullable();
            $table->string('latitude',25)->nullable();
            $table->string('longitude',25)->nullable();
            $table->integer('areaId')->nullable()->index();
            $table->tinyInteger('createdBy');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tboffice_location');
    }
}
