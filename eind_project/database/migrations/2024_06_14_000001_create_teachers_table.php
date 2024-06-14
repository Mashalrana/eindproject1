<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('teacher_id');
            $table->string('teacher_name');
            $table->unsignedBigInteger('account_id');
            $table->timestamps();

            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
