<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_quiz')) {
            Schema::create('user_quiz', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->onDelete('cascade');
                $table->foreignId('quiz_topic_id')->onDelete('cascade');
                $table->float('quiz_mark')->nullable();
                $table->float('speaking_mark')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_quiz');
    }
}
