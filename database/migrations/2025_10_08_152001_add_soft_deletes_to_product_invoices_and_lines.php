<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('product_invoices', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('product_invoice_lines', function (Blueprint $table) {
            if (!Schema::hasColumn('product_invoice_lines', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('product_invoice_lines', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
