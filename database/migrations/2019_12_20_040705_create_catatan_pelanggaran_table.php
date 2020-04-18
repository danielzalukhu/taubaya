<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatatanPelanggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violation_records', function (Blueprint $table) {
            $table->increments('id');
            $table->date('DATE');
            $table->double('TOTAL');
            $table->text('DESCRIPTION');
            $table->text('PUNISHMENT');
            $table->integer('STUDENTS_ID')->unsigned();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('VIOLATIONS_ID')->unsigned();
            $table->foreign('VIOLATIONS_ID')->references('id')->on('violations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('violationRecords');
    }
}
