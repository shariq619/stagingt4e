<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohort_user', function (Blueprint $table) {
            $table->id();
            $table->integer('cohort_id');
            $table->integer('user_id');
            $table->enum('status', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('learner_cohort');
    }
}
