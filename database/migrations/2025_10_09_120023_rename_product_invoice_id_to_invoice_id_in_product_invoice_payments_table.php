<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('
            ALTER TABLE `product_invoice_payments`
            CHANGE `product_invoice_id` `invoice_id` BIGINT UNSIGNED NOT NULL,
            ADD INDEX (`invoice_id`);
        ');
    }

    public function down(): void
    {
        DB::statement('
            ALTER TABLE `product_invoice_payments`
            CHANGE `invoice_id` `product_invoice_id` BIGINT UNSIGNED NOT NULL,
            ADD INDEX (`product_invoice_id`);
        ');
    }
};
