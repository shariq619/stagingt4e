<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE `product_invoices`
            ADD COLUMN `invoice_status` ENUM(
                'Credit',
                'No Show',
                'Outstanding',
                'Overdue',
                'Paid',
                'Part-Credit',
                'Part-Paid'
            ) NOT NULL DEFAULT 'Outstanding'
            AFTER `invoice_date`
        ");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `product_invoices` DROP COLUMN `invoice_status`");
    }
};
