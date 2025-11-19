<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseElearningLicenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('course_elearning_licence', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('course_id');
//            $table->unsignedBigInteger('elearning_licence_id');
//            // Add any additional fields you may need for this pivot table
//
//            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
//            $table->foreign('elearning_licence_id')->references('id')->on('elearning_licences')->onDelete('cascade');
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_elearning_licence');
    }
}
