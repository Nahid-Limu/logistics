<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarbonEmissionReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carbon_emission_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('january');
            $table->string('february');
            $table->string('march');
            $table->string('april');
            $table->string('may');
            $table->string('june');
            $table->string('july');
            $table->string('august');
            $table->string('september');
            $table->string('october');
            $table->string('november');
            $table->string('december');
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
        Schema::dropIfExists('carbon_emission_report');
    }
}
