<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->enum('type',['heures_supplementaires','autres']);
            $table->longText('motif');
            $table->timestamp('debut');
            $table->timestamp('fin');
            $table->enum('status', ['attente','en_cours','valid','refus'])->default('attente')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        
        Schema::dropIfExists('bonuses');
    } 
}
