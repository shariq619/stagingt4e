<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplateVersionsTable extends Migration
{
    public function up()
    {
        Schema::create('email_template_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('template_id')->index();
            $table->unsignedInteger('version');
            $table->boolean('is_current')->default(false);
            $table->text('layout_html')->nullable();
            $table->text('layout_text')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['template_id', 'version']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_template_versions');
    }
}
