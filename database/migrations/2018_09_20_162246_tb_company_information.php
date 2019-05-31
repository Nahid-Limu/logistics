<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbCompanyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_company_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',50);
            $table->string('company_phone',30)->nullable();
            $table->string('company_email',30)->nullable();
            $table->text('company_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_company_information');
    }
}
