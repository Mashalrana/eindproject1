<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulersTable extends Migration
{
    public function up()
    {
        Schema::create('schedulers', function (Blueprint $table) {
            $table->id('scheduler_id');
            $table->string('scheduler_name');
            $table->unsignedBigInteger('account_id');
            $table->timestamps();

            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedulers');
    }
}
