<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->date('contact_date')->nullable();
            $table->string('candidate_name',150);
            $table->string('contact_number',50)->nullable();
            $table->string('email')->nullable();
            $table->string('course_interested',150)->nullable();
            $table->string('city',120)->nullable();
            $table->enum('status',[
                'enrolled',
                'do_not_disturb',
                'last_hope',
                'processing',
                'pending',
                'not_interested',
                'need_to_followup'
            ])->default('pending');
            $table->date('enrolment_date')->nullable();
            $table->integer('created_by_id')->nullable()->index();;
            $table->string('platform',120)->nullable();
            $table->string('source',120)->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('follow_up_at')->nullable();
            $table->dateTime('follow_up2_at')->nullable();
            $table->dateTime('follow_up_final_at')->nullable();
            $table->integer('course_id')->nullable()->index();
            $table->integer('user_id')->nullable()->index();
            $table->timestamps();
            $table->index(['status','city']);
            $table->index(['contact_date']);
            $table->index(['enrolment_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
