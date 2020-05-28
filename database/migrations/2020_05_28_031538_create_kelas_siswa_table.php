<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('STUDENTS_ID')->nullable();            
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('GRADES_ID')->nullable();
            $table->foreign('GRADES_ID')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('ACADEMIC_YEAR_ID')->nullable();
            $table->foreign('ACADEMIC_YEAR_ID')->references('id')->on('academic_years')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('grades_students');
    }
}
