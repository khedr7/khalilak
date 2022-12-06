<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_levels', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->string('icon', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->enum('status', array('1', '0'));
            $table->foreignId('chapter_id')->onDelete('cascade');
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
        Schema::dropIfExists('chapter_levels');
    }
}
