<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SUBJECTS_ID')->unsigned();
            $table->foreign('SUBJECTS_ID')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('REPORTS_ID')->unsigned();
            $table->foreign('REPORTS_ID')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->double('FINAL_SCORE');
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
        Schema::dropIfExists('reports_subjects');
    }
}
