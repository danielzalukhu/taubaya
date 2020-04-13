<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KD', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NUMBER', 45);
            $table->string('DESCRIPTION', 45);
            $table->integer('SUBJECTS_ID')->unsigned();
            $table->foreign('SUBJECTS_ID')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('KD');
    }
}
