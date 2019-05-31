<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id');
            $table->index('emp_id');
            $table->string('empExamTitle','50');
            $table->string('empInstitution','150')->nullable();
            $table->string('empResult','20');
            $table->string('empScale','20')->nullable();
            $table->string('empPassYear','4')->nullable();
            $table->string('empCertificate','250')->nullable();
            $table->integer('created_by')->nullable()->index();
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
        Schema::dropIfExists('employee_education');
    }
}
