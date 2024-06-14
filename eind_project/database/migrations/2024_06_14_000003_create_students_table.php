<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_name');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('account_id');
            $table->timestamps();

            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
