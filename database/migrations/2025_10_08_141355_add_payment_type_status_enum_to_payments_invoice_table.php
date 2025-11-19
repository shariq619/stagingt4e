<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE product_invoice_payments
            MODIFY COLUMN payment_type ENUM(
                'BACS Transfer',
                'Cash',
                'Cheque',
                'Credit / Debit Card',
                'Direct Debit',
                'Hurak Marketplace Platform',
                'Payl8r',
                'PayPal',
                'Reed Courses',
                'Website'
            ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE product_invoice_payments
            MODIFY COLUMN payment_type VARCHAR(40) NOT NULL");
    }
};
