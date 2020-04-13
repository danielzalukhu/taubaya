<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenghargaanSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('STUDENTS_ID')->unsigned();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ACHIEVEMENTS_ID')->unsigned();
            $table->foreign('ACHIEVEMENTS_ID')->references('id')->on('achievements')->onDelete('cascade')->onUpdate('cascade');
            $table->date('DATE');
            $table->text('DESCRIPTION');
            $table->integer('ACADEMIC_YEAR_ID')->unsigned();
            $table->foreign('ACADEMIC_YEAR_ID')->references('id')->on('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('STAFFS_ID')->unsigned();
            $table->foreign('STAFFS_ID')->references('id')->on('staffs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('achievements_students');
    }
}
