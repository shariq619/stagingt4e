<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE front_order_details MODIFY COLUMN status VARCHAR(50)");
        DB::statement("
            UPDATE front_order_details
            SET status = CASE
                WHEN status IN ('Pending','Zero Paid') THEN 'Unpaid'
                WHEN status IN ('Partially Paid','Overdue','Outstanding') THEN 'Outstanding'
                WHEN status = 'Paid' THEN 'Paid'
                ELSE 'Unpaid'
            END
        ");
        DB::statement("
            ALTER TABLE front_order_details
            MODIFY COLUMN status ENUM('Unpaid', 'Outstanding', 'Paid')
            NOT NULL DEFAULT 'Unpaid'
        ");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE front_order_details MODIFY COLUMN status VARCHAR(50)");
        DB::statement("
            UPDATE front_order_details
            SET status = CASE
                WHEN status = 'Unpaid' THEN 'Pending'
                WHEN status = 'Outstanding' THEN 'Partially Paid'
                WHEN status = 'Paid' THEN 'Paid'
                ELSE 'Pending'
            END
        ");
        DB::statement("
            ALTER TABLE front_order_details
            MODIFY COLUMN status ENUM('Pending', 'Zero Paid', 'Partially Paid', 'Overdue', 'Paid')
            NOT NULL DEFAULT 'Pending'
        ");
    }
};
