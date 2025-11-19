<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_post_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cohort_id')->nullable();
            $table->enum('qualification_status',['Passed','Failed']);
            $table->date('date_of_last_expiry')->nullable();
            $table->date('registration_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_post_qualifications');
    }
};
