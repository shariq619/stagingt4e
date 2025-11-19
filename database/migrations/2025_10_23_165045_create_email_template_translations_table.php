<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('email_template_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('template_version_id')->index();
            $table->string('locale', 10)->default('en');
            $table->string('subject');
            $table->text('html_body')->nullable();
            $table->text('text_body')->nullable();
            $table->timestamps();

            $table->unique(['template_version_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_template_translations');
    }
}
