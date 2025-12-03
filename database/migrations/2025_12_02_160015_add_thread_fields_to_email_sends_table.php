<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('email_sends', function (Blueprint $table) {
            $table->string('provider_message_id')->nullable()->after('provider_key');
            $table->integer('email_thread_id')->index()->nullable()->after('provider_message_id');

        });
    }

    public function down(): void
    {
        Schema::table('email_sends', function (Blueprint $table) {
            $table->dropColumn(['provider_message_id', 'email_thread_id']);
        });
    }
};
