<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NAME', 45);
            $table->text('DESCRIPTION');
            $table->unsignedInteger('PROGRAMS_ID');
            $table->foreign('PROGRAMS_ID')->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('STAFFS_ID');
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
        Schema::dropIfExists('classes');
    }
}
