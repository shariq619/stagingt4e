<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('email_template_versions', function (Blueprint $table) {
            $table->json('attachments')->nullable()->after('meta');
        });
    }

    public function down(): void
    {
        Schema::table('email_template_versions', function (Blueprint $table) {
            $table->dropColumn('attachments');
        });
    }
};
