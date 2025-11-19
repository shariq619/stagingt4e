<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('form_responses', function (Blueprint $table) {
//            $table->id();
//            $table->integer('user_id');
//            $table->integer('task_id');
//            $table->string('task_name');
//            $table->string('pdf');
//            $table->json('response');
//            $table->json('learner_response')->nullable();
//            $table->enum('status', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted');
//            $table->text('comments')->nullable(); // Add comments column
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
        Schema::dropIfExists('form_responses');
    }
}
