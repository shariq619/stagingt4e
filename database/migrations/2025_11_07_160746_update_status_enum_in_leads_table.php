<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE `leads`
            MODIFY `status` ENUM(
                'enrolled',
                'do_not_disturb',
                'last_hope',
                'processing',
                'pending',
                'not_interested',
                'need_to_followup',
                'interested'
            ) NOT NULL DEFAULT 'pending' COLLATE 'utf8mb4_unicode_ci'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `leads`
            MODIFY `status` ENUM(
                'enrolled',
                'do_not_disturb',
                'last_hope',
                'processing',
                'pending',
                'not_interested',
                'need_to_followup'
            ) NOT NULL DEFAULT 'pending' COLLATE 'utf8mb4_unicode_ci'");
    }
};
