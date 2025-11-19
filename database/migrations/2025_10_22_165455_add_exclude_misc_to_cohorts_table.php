<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            if (!Schema::hasColumn('cohorts', 'exclude_misc')) {
                $table->boolean('exclude_misc')->default(false)->after('max_learner');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            if (Schema::hasColumn('cohorts', 'exclude_misc')) {
                $table->dropColumn('exclude_misc');
            }
        });
    }
};
