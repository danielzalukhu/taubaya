<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ATT_ID', 45);
            $table->string('CARD_NUM', 45);
            $table->string('NIS', 45);
            $table->string('PASSWORD', 255);
            $table->string('NISN', 45);
            $table->string('NIK', 45);
            $table->string('FNAME', 45);
            $table->string('LNAME', 45);
            $table->ENUM('GENDER', ['MALE','FEMALE']);
            $table->string('BPLACE', 45);
            $table->date('BDATE');
            $table->string('MAIL', 45);
            $table->string('PHONE', 20);
            $table->string('ADDRESS', 45);
            $table->string('RT', 45);
            $table->string('RW', 45);
            $table->string('DISTRICT', 45);
            $table->string('SUBDISTRICT', 45);
            $table->string('CITY', 45);
            $table->string('PROVINCE', 45);
            $table->string('GR_FROM', 45);
            $table->string('BANK_ACC', 45);
            $table->ENUM('STATUS', ['STUDENT', 'ALUMNI', 'SUSPEND', 'INACTIVE']);
            $table->text('NOTES');
            $table->text('IMG_PATH');
            $table->unsignedInteger('BANKS_ID');
            $table->foreign('BANKS_ID')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('RELIGIONS_ID');
            $table->foreign('RELIGIONS_ID')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('GRADES_ID');
            $table->foreign('GRADES_ID')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('TOKENS_ID');
            $table->foreign('TOKENS_ID')->references('id')->on('tokens')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('USERS_EMAIL');
            $table->foreign('USERS_EMAIL')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('students');
    }
}
