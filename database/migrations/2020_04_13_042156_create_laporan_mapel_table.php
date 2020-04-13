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
        Schema::create('subject_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SUBJECTS_ID')->unsigned();
            $table->foreign('SUBJECTS_ID')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('SUBJECT_RECORD_ID')->unsigned();
            $table->foreign('SUBJECT_RECORD_ID')->references('id')->on('subject_records')->onDelete('cascade')->onUpdate('cascade');
            $table->double('FINAL_SCORE');
            $table->tinyInteger('IS_VERIFIED');
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
        Schema::dropIfExists('subject_reports');
    }
}
