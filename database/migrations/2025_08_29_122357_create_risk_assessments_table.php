<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cohort_id')->constrained()->onDelete('cascade');
            $table->foreignId('venue_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');

            $table->string('course_name');   // denormalized for reporting
            $table->string('trainer_name');  // denormalized for reporting

            $table->string('tutor_assessing')->nullable();
            $table->string('location_assessed')->nullable();
            $table->string('delegates')->nullable();
            $table->string('dimensions')->nullable();

            // Checklist stored as JSON (safe/unsafe + comments)
            $table->json('checklist')->nullable();

            $table->text('hazards')->nullable();
            $table->text('control_measures')->nullable();

            $table->longText('tutor_signature')->nullable();
            $table->date('sign_date')->nullable();

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
        Schema::dropIfExists('risk_assessments');
    }
}
