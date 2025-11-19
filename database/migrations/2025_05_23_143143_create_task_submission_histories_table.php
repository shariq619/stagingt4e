<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSubmissionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_submission_histories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('task_submission_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('cohort_id');
            $table->unsignedBigInteger('trainer_id')->nullable();

            $table->string('scorm_registration_id')->nullable();
            $table->text('scorm_course_link')->nullable();

            $table->timestamp('archived_at'); // Time this record was archived
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
        Schema::dropIfExists('task_submission_histories');
    }
}
