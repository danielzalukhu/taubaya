<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBobotAktivitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_weights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SUBJECTS_ID')->unsigned();
            $table->foreign('SUBJECTS_ID')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ACTIVITIES_ID')->unsigned();
            $table->foreign('ACTIVITIES_ID')->references('id')->on('activites')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ACADEMIC_YEAR_ID')->unsigned();
            $table->foreign('ACADEMIC_YEAR_ID')->references('id')->on('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->double('WEIGHT');
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
        Schema::dropIfExists('activities_weights');
    }
}
