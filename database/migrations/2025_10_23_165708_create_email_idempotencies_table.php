<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailIdempotenciesTable extends Migration
{
    public function up()
    {
        Schema::create('email_idempotency', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_key');
            $table->string('recipient_email');
            $table->string('hash')->unique();
            $table->timestamps();

            $table->index(['event_key', 'recipient_email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_idempotency');
    }
}
