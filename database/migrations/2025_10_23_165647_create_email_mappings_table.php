<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMappingsTable extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('email_mappings');
        Schema::create('email_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trigger_id')->index();
            $table->integer('template_id')->index();
            $table->string('scope')->default('global');
            $table->string('course_category')->nullable();
            $table->integer('course_id')->nullable()->index();
            $table->json('recipients')->nullable();
            $table->boolean('enabled')->default(true);
            $table->unsignedInteger('priority')->default(100);
            $table->timestamps();


            $table->index(['scope', 'course_category', 'course_id']);
            $table->index(['trigger_id', 'priority']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_mappings');
    }
}
