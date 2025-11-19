<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The learner
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('license_id')->nullable();

            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('cohort_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();

            $table->string('scorm_registration_id')->nullable();
            $table->string('scorm_course_id')->nullable();
            $table->string('scorm_course_img')->nullable();
            $table->string('scorm_course_link')->nullable();


            $table->string('pdf')->nullable();
            $table->json('response')->nullable();
            $table->json('learner_response')->nullable();
            $table->json('trainer_response')->nullable();
            $table->json('high_field_response')->nullable();
            $table->enum('status', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted');
            $table->text('comments')->nullable(); // Add comments column
            $table->timestamps();

            // Adding foreign key constraints (optional, but recommended)
        //    $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
       //     $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
       //     $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign keys
        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       //     $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_submissions');
    }
}
