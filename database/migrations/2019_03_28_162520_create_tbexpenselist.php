<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbexpenselist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbexpenselist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('categoryId')->nullable()->index();
            $table->float('amount')->nullable();
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->date('expenseDate')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('tbexpenselist');
    }
}
