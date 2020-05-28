<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FIRST_NAME');
            $table->string('LAST_NAME');
            $table->string('B_YEAR');
            $table->ENUM('STATUS',['FATHER', 'MOTHER', 'OTHER']);
            $table->string('JOB');
            $table->string('EDUCATION');
            $table->string('PHONE');
            $table->string('EMAIL');
            $table->text('ADDRESS');
            $table->unsignedInteger('STUDENTS_ID')->nullable();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('guardians');
    }
}
