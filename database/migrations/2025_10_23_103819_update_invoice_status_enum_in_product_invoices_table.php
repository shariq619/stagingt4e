<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('product_invoices', 'status')) {
            Schema::table('product_invoices', function ($table) {
                $table->dropColumn('status');
            });
        }

        DB::statement("ALTER TABLE product_invoices MODIFY COLUMN invoice_status VARCHAR(50)");
        DB::statement("
            UPDATE product_invoices
            SET invoice_status = CASE
                WHEN invoice_status IN ('Pending','Zero Paid') THEN 'Unpaid'
                WHEN invoice_status IN ('Partially Paid','Overdue','Outstanding') THEN 'Outstanding'
                WHEN invoice_status = 'Paid' THEN 'Paid'
                ELSE 'Unpaid'
            END
        ");
        DB::statement("
            ALTER TABLE product_invoices
            MODIFY COLUMN invoice_status ENUM('Unpaid', 'Outstanding', 'Paid')
            NOT NULL DEFAULT 'Unpaid'
        ");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE product_invoices MODIFY COLUMN invoice_status VARCHAR(50)");
        DB::statement("
            UPDATE product_invoices
            SET invoice_status = CASE
                WHEN invoice_status = 'Unpaid' THEN 'Pending'
                WHEN invoice_status = 'Outstanding' THEN 'Partially Paid'
                WHEN invoice_status = 'Paid' THEN 'Paid'
                ELSE 'Pending'
            END
        ");
        DB::statement("
            ALTER TABLE product_invoices
            MODIFY COLUMN invoice_status ENUM('Pending', 'Zero Paid', 'Partially Paid', 'Overdue', 'Paid')
            NOT NULL DEFAULT 'Pending'
        ");

        if (!Schema::hasColumn('product_invoices', 'status')) {
            Schema::table('product_invoices', function ($table) {
                $table->string('status', 50)->nullable()->after('invoice_status');
            });
        }
    }
};
