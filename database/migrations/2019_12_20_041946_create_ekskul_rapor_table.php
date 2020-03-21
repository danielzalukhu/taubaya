<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkskulRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracurriculars_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('REPORTS_ID')->unsigned();
            $table->foreign('REPORTS_ID')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('EXTRACURRICULARS_ID')->unsigned();
            $table->foreign('EXTRACURRICULARS_ID')->references('id')->on('extracurriculars')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('extracurriculars_reports');
    }
}
