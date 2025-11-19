<?php

// database/migrations/2025_11_10_000002_add_created_by_id_to_email_templates_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('email_templates', function (Blueprint $table) {
            $table->integer('created_by_id')
                ->nullable()
                ->after('code')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('email_templates', function (Blueprint $table) {
            $table->dropColumn('created_by_id');
        });
    }
};
