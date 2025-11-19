<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_invoice_payments', function (Blueprint $table) {
            $table->dropUnique(['payment_ref']);
        });
    }

    public function down(): void
    {
        Schema::table('product_invoice_payments', function (Blueprint $table) {
            $table->unique('payment_ref');
        });
    }
};
