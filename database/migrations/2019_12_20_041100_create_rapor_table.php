<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('TEACHER_MSG');
            $table->text('PARENT_MSG');
            $table->tinyInteger('IS_VERIFIED');
            $table->text('CONCLUSION');
            $table->tinyInteger('PARENTS_SIGNATURE');
            $table->unsignedInteger('STUDENTS_ID');
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('ACADEMIC_YEAR_ID');
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
        Schema::dropIfExists('reports');
    }
}
