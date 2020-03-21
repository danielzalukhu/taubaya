<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NIK', 45);
            $table->string('NAME',45);
            $table->enum('ROLE', ['TEACHER', 'ADMIN', 'MEDICAL', 'ADVISOR']);
            $table->unsignedInteger('USERS_EMAIL');
            $table->foreign('USERS_EMAIL')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('DEPARTMENTS_ID');
            $table->foreign('DEPARTMENTS_ID')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('staffs');
    }
}
