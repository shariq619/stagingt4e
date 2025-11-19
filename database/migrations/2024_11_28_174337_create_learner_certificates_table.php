<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learner_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Learner ID
            $table->unsignedBigInteger('course_id')->nullable(); // Course ID (optional)
            $table->unsignedBigInteger('cohort_id')->nullable(); // Cohort ID (optional)
            $table->string('certificate_path'); // Path to the certificate file
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learner_certificates');
    }
}
