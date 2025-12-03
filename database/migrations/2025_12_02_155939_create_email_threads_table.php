<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_threads', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->string('root_message_id')->nullable()->index();
            $table->string('related_type')->nullable();
            $table->integer('related_id')->index()->nullable();
            $table->integer('created_by_user_id')->index()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_threads');
    }
};
