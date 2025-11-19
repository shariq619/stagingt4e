<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN learner_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional - Admin Staff to follow up',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");

        DB::statement("
            ALTER TABLE front_order_details
            MODIFY COLUMN course_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional - Admin Staff to follow up',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");

        DB::table('users')
            ->where('learner_status', 'Provisional - Admin Staff to follow up')
            ->update(['learner_status' => 'Provisional']);

        DB::table('front_order_details')
            ->where('course_status', 'Provisional - Admin Staff to follow up')
            ->update(['course_status' => 'Provisional']);

        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN learner_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");

        DB::statement("
            ALTER TABLE front_order_details
            MODIFY COLUMN course_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN learner_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional - Admin Staff to follow up',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");

        DB::statement("
            ALTER TABLE front_order_details
            MODIFY COLUMN course_status ENUM(
                'Cancelled',
                'Confirmed',
                'Drop-Out',
                'Failed',
                'HSA Resit',
                'No Show',
                'Non-Attendance',
                'Passed',
                'Provisional - Admin Staff to follow up',
                'Provisional',
                'Transferred'
            ) NULL DEFAULT NULL
        ");

        DB::table('users')
            ->where('learner_status', 'Provisional')
            ->update(['learner_status' => 'Provisional - Admin Staff to follow up']);

        DB::table('front_order_details')
            ->where('course_status', 'Provisional')
            ->update(['course_status' => 'Provisional - Admin Staff to follow up']);
    }
};
