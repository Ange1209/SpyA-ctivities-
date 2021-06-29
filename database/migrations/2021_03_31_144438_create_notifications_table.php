<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
   
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('bonus_id');
            $table->foreign('bonus_id')->references('id')->on('bonuses');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
