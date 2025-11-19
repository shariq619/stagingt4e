<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSendEventsTable extends Migration
{
    public function up()
    {
        Schema::create('email_send_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('email_send_id')->index();
            $table->string('type');
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->index(['type', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_send_events');
    }
}
