<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('product_invoices', 'additional_invoice_details')) {
                $table->text('additional_invoice_details')->nullable()->after('status');
            }
            if (!Schema::hasColumn('product_invoices', 'carriage')) {
                $table->decimal('carriage', 12, 2)->default(0)->after('total_gross');
            }
            if (!Schema::hasColumn('product_invoices', 'discount_amount')) {
                $table->decimal('discount_amount', 12, 2)->default(0)->after('carriage');
            }
            if (!Schema::hasColumn('product_invoices', 'discount_percent')) {
                $table->decimal('discount_percent', 5, 2)->default(0)->after('discount_amount');
            }
            if (!Schema::hasColumn('product_invoices', 'discount_vat_rate')) {
                $table->decimal('discount_vat_rate', 5, 2)->default(0)->after('discount_percent');
            }
            if (!Schema::hasColumn('product_invoices', 'misc_cost')) {
                $table->decimal('misc_cost', 12, 2)->default(0)->after('discount_vat_rate');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            $drop = [
                'additional_invoice_details',
                'carriage',
                'discount_amount',
                'discount_percent',
                'discount_vat_rate',
                'misc_cost',
            ];
            foreach ($drop as $col) {
                if (Schema::hasColumn('product_invoices', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
