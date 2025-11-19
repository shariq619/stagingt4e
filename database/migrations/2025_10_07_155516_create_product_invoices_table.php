<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_invoices', function (Blueprint $t) {
            $t->id();
            $t->string('invoice_no')->unique()->nullable();
            $t->foreignId('cohort_id')->index();
            $t->foreignId('user_id')->index();
            $t->foreignId('front_order_id')->nullable()->index();
            $t->foreignId('order_detail_id')->index();
            $t->dateTime('invoice_date')->nullable();
            $t->string('status')->default('Credit')->nullable();
            $t->decimal('total_net', 12, 2)->default(0)->nullable();
            $t->decimal('total_vat', 12, 2)->default(0)->nullable();
            $t->decimal('total_gross', 12, 2)->default(0)->nullable();
            $t->string('pdf_url')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_invoices');
    }
};
