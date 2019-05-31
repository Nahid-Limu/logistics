<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbzoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbzone', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('areaId');
            $table->string('name',150);
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
        Schema::dropIfExists('tbzone');
    }
}
