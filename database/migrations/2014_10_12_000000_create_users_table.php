<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('methodology_id')->nullable();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->string('birth_place')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();

            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();




//            $table->text('GeneralEnrolment')->nullable();
//            $table->text('CourseWork')->nullable();
//            $table->text('Reminders')->nullable();
//            $table->text('PostCompletion')->nullable();

            $table->string('image')->nullable();
            $table->integer('password_check')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
