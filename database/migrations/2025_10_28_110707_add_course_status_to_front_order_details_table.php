<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->enum('course_status', [
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional',
                'Transferred',
            ])->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->dropColumn('course_status');
        });
    }
};
