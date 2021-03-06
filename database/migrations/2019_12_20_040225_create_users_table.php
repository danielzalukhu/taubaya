<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->ENUM('ROLE', ['STAFF', 'STUDENT', 'PARENT']);
            $table->unsignedInteger('STAFFS_ID')->nullable();
            $table->foreign('STAFFS_ID')->references('id')->on('staffs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('STUDENTS_ID')->nullable();
            $table->foreign('STUDENTS_ID')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('GUARDIANS_ID')->nullable();
            $table->foreign('GUARDIANS_ID')->references('id')->on('guardians')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}
