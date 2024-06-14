<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id('conversation_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id');
            $table->date('conversation_date');
            $table->text('conversation_content');
            $table->timestamp('schedule_time')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
