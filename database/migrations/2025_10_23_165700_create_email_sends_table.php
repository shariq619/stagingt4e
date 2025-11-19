<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSendsTable extends Migration
{
    public function up()
    {
        Schema::create('email_sends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_key');
            $table->string('recipient_email');
            $table->string('template_code');
            $table->integer('template_version_id')->nullable();
            $table->string('locale', 10)->default('en');
            $table->string('provider_key')->default('smtp');
            $table->string('status')->default('queued');
            $table->unsignedInteger('attempts')->default(0);
            $table->text('subject')->nullable();
            $table->longText('html_body')->nullable();
            $table->longText('text_body')->nullable();
            $table->json('context')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['event_key', 'recipient_email']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_sends');
    }
}
