<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartemenKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('STAFFS_ID');
            $table->foreign('STAFFS_ID')->references('id')->on('staffs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('departments_staffs');
    }
}
