<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('newsletters') && Schema::hasColumn('newsletters', 'data_source')) {
            Schema::table('newsletters', function (Blueprint $table) {
                $table->dropColumn('data_source');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('newsletters') && !Schema::hasColumn('newsletters', 'data_source')) {
            Schema::table('newsletters', function (Blueprint $table) {
                $table->string('data_source')->nullable()->after('subject');
            });
        }
    }
};
