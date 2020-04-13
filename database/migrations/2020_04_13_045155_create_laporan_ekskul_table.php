<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanEkskulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracurricular_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('EXTRACURRICULARS_ID')->unsigned();
            $table->foreign('EXTRACURRICULARS_ID')->references('id')->on('extracurriculars')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('EXTRACURRICULAR_REPORT_ID')->unsigned();
            $table->foreign('EXTRACURRICULAR_REPORT_ID')->references('id')->on('extracurricular_records')->onDelete('cascade')->onUpdate('cascade');
            $table->double('SCORE');
            $table->text('DESCRIPTION');
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
        Schema::dropIfExists('extracurricular_reports');
    }
}
