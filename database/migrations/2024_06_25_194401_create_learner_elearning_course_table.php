<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnerElearningCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learner_elearning_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learner_id');
            $table->string('registration_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('course_name');
            $table->string('course_img')->nullable();
            $table->string('course_link')->nullable();
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
        Schema::dropIfExists('learner_elearning_courses');
    }
}
