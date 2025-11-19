<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('email_send_events', function (Blueprint $table) {
            $table->integer('user_id')
                ->nullable()
                ->after('email_send_id');

            $table->index('user_id', 'email_send_events_user_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('email_send_events', function (Blueprint $table) {
            $table->dropIndex('email_send_events_user_id_index');
            $table->dropColumn('user_id');
        });
    }
};
