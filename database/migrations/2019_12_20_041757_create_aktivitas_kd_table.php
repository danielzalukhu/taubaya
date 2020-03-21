<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktivitasKdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_KD', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('KD_ID')->unsigned();
            $table->foreign('KD_ID')->references('id')->on('KD')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ACTIVITIES_ID')->unsigned();
            $table->foreign('ACTIVITIES_ID')->references('id')->on('activities')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('activities_KD');
    }
}
