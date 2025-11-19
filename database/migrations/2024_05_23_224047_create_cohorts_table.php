<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->integer('max_learner');
            $table->integer('course_id');
            $table->integer('venue_id');
            $table->integer('trainer_id')->nullable();
            $table->string('delivery_mode')->nullable();
            $table->integer('corporate_client_id')->nullable();
            $table->dateTime('start_date_time')->nullable();
                $table->dateTime('end_date_time')->nullable();
            $table->json('additional_times')->nullable();
            $table->string('booking_reference')->nullable();
            $table->string('lesson_plan')->nullable();
            $table->string('invoice')->nullable();
            $table->enum('status', ['Confirmed ', 'Complete', 'Cancelled'])->default('Confirmed');
            $table->tinyInteger('user_id')->nullable();
            $table->tinyInteger('is_weekend')->default(0)->comment('1 = Yes, 0 = No');
            $table->tinyInteger('is_soldout')->default(0)->comment('1 = Yes, 0 = No');
            $table->tinyInteger('cohort_status')->default(1)->comment('1 = Active, 0 = Inactive');
            $table->timestamps();
            $table->softDeletes(); // Add this line
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cohorts');
    }
}
