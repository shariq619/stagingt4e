<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            $table->string('order_no')
                ->nullable()
                ->after('invoice_no')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('product_invoices', function (Blueprint $table) {
            $table->dropIndex(['order_no']);
            $table->dropColumn('order_no');
        });
    }
};
