<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('course_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('name');
            $table->string('color_code')->nullable();
            $table->integer('category_id');
            $table->string('qualification');
            $table->text('banner_description')->nullable();
            $table->text('description');
            $table->decimal('vat', 8, 2)->default(0.00);
            $table->decimal('price', 8, 2);
            $table->string('duration');
            $table->text('requirements')->nullable();
            $table->string('certification')->nullable();
            $table->string('awarding_bodies')->nullable();
            //$table->text('exam')->nullable();
            $table->string('delivery_mode');
            $table->text('key_information')->nullable();
            $table->string('course_type')->nullable();
            $table->text('course_structure')->nullable();
            $table->string('qualification_type')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->text('long_desc')->nullable();
            $table->json('faqs')->nullable();
            $table->json('custom_fields')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
