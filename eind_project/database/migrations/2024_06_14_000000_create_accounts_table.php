<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('account_username');
            $table->string('account_password');
            $table->enum('role', ['admin', 'teacher', 'student', 'scheduler'])->default('student');
            $table->string('address');
            $table->string('postcode', 10);
            $table->string('city');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
