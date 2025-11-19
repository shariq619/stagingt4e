<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('learner_id');
            $table->integer('is_valid_form')->default(0);
            $table->string('father_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('birth_date');
            $table->string('address');
            $table->string('learner_pdf');
            $table->string('nationality');
            $table->string('email')->unique();
            $table->string('post_code');
            $table->string('phone_number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('name')->nullable();
            $table->string('contact_num')->nullable();
            $table->string('relationship_to_you')->nullable();
            $table->string('company')->nullable();
            $table->string('emp_contact_name')->nullable();
            $table->string('emp_contact_num')->nullable();
            $table->string('emp_copmany_address')->nullable();
            $table->string('emp_post_code')->nullable();
            $table->string('levy_number')->nullable();
            $table->string('hear_about')->nullable();
            $table->text('pdf')->nullable();
            $table->tinyInteger('guideline1')->nullable();
            $table->tinyInteger('guideline2')->nullable();
            $table->tinyInteger('guideline3')->nullable();
            $table->boolean('term');
            $table->enum('status', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted');
            $table->text('comments')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('application_forms');
    }
}
