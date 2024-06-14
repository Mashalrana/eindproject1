<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->date('schedule_date');
            $table->timestamp('schedule_time')->nullable();
            $table->timestamps();

            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
