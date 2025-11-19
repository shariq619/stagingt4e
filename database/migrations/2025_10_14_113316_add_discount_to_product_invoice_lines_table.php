<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_invoice_lines', function (Blueprint $table) {
            if (!Schema::hasColumn('product_invoice_lines', 'discount')) {
                $table->decimal('discount', 12, 2)->nullable()->after('unit_cost')
                    ->comment('Gross discount amount applied on the line (before VAT recalculation)');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_invoice_lines', function (Blueprint $table) {
            if (Schema::hasColumn('product_invoice_lines', 'discount')) {
                $table->dropColumn('discount');
            }
        });
    }
};
