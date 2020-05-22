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
            $table->string('ATT_ID', 45)->nullable();
            $table->string('CARD_NUM', 45)->nullable();
            $table->string('NIS', 45)->nullable();
            $table->string('PASSWORD', 255)->nullable();
            $table->string('NISN', 45);
            $table->string('NIK', 45)->nullable();
            $table->string('FNAME', 45);
            $table->string('LNAME', 45);
            $table->ENUM('GENDER', ['MALE','FEMALE'])->nullable();
            $table->string('BPLACE', 45)->nullable();
            $table->date('BDATE')->nullable();
            $table->string('MAIL', 45)->nullable();
            $table->string('PHONE', 20)->nullable();
            $table->string('ADDRESS', 45)->nullable();
            $table->string('RT', 45)->nullable();
            $table->string('RW', 45)->nullable();
            $table->string('DISTRICT', 45)->nullable();
            $table->string('SUBDISTRICT', 45)->nullable();
            $table->string('CITY', 45)->nullable();
            $table->string('PROVINCE', 45)->nullable();
            $table->string('GR_FROM', 45)->nullable();
            $table->string('BANK_ACC', 45)->nullable();
            $table->ENUM('STATUS', ['STUDENT', 'ALUMNI', 'SUSPEND', 'INACTIVE'])->nullable();
            $table->text('NOTES')->nullable();
            $table->text('IMG_PATH')->nullable();
            $table->unsignedInteger('BANKS_ID')->nullable();
            $table->foreign('BANKS_ID')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('RELIGIONS_ID')->nullable();
            $table->foreign('RELIGIONS_ID')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('ACADEMIC_YEAR_ID')->nullable();
            $table->foreign('ACADEMIC_YEAR_ID')->references('id')->on('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('GRADES_ID')->nullable();
            $table->foreign('GRADES_ID')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('TOKENS_ID')->nullable();
            $table->foreign('TOKENS_ID')->references('id')->on('tokens')->onDelete('cascade')->onUpdate('cascade');
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
