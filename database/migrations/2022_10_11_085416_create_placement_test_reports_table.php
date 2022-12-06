<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementTestReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_test_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->foreignId('quiz_topic_id')->onDelete('cascade');
            $table->string('general_mark')->nullable();
            $table->string('reading_mark')->nullable();
            $table->string('listening_mark')->nullable();
            $table->string('speaking_mark')->nullable();
            $table->string('final_mark')->nullable();

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
        Schema::dropIfExists('placement_test_reports');
    }
}
