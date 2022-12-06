<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVolunteerToInstuctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            // $table->boolean('blind'); // 1 = blind, 0 = Sighted
            // $table->text('latest_obtained_degree');  //Ph.D , MA , BA , Baccalaureate , Elementary school
            // $table->boolean('degree_completed'); // 1 = completed, 0 = Still Studying
            // $table->text('study');  
            // $table->string('profession', 191)->nullable(); //(Optional) 
            // $table->text('association'); // Al Weam Society for Blind Females, Blind Society, others(Please specify).  
            // $table->string('english_level', 191); //Beginner , Intermediate, Advanced.
            $table->text('comment')->nullable();

            $table->string('disabled')->nullable();
            $table->string('Reason_for_joining')->nullable();
            $table->string('type')->nullable();
            $table->date('interview_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            //
        });
    }
}
