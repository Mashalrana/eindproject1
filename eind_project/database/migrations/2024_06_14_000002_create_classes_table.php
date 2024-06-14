<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->string('class_name');
            $table->unsignedBigInteger('mentor')->nullable();
            $table->timestamps();

            $table->foreign('mentor')->references('teacher_id')->on('teachers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
