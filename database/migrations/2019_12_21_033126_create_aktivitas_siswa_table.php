<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktivitasSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('STUDENTS_ID')->unsigned();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ACTIVITIES_ID')->unsigned();
            $table->foreign('ACTIVITIES_ID')->references('id')->on('activities')->onDelete('cascade')->onUpdate('cascade');
            $table->double('SCORE');
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
        Schema::dropIfExists('activities_students');
    }
}
