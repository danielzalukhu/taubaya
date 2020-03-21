<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->increments('id');
            $table->date('START_DATE');
            $table->date('END_DATE');
            $table->ENUM('TYPE', ['ABSENT','LEAVE', 'SICK']);
            $table->text('DESCRIPTION');
            $table->text('RECEIPT_IMG');
            $table->integer('STUDENTS_ID')->unsigned();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');            
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
        Schema::dropIfExists('absents');
    }
}
