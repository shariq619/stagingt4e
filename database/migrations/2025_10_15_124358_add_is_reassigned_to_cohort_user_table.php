<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cohort_user', function (Blueprint $table) {
            $table->boolean('is_reassigned')->after('status')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('cohort_user', function (Blueprint $table) {
            $table->dropColumn('is_reassigned');
        });
    }
};
