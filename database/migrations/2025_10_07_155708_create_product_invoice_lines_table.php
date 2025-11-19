<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_invoice_lines', function (Blueprint $t) {
            $t->id();
            $t->foreignId('invoice_id')->index();
            $t->unsignedInteger('qty')->default(1);
            $t->string('product_code')->nullable();
            $t->string('product_description')->nullable();
            $t->decimal('unit_cost',12,2)->default(0);
            $t->decimal('vat_rate',6,2)->default(20.00);
            $t->decimal('discount',12,2)->default(0);
            $t->decimal('net_amount',12,2)->default(0);
            $t->decimal('vat_amount',12,2)->default(0);
            $t->decimal('gross_amount',12,2)->default(0);
            $t->boolean('assembly')->default(false);
            $t->decimal('weight',10,3)->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('product_invoice_lines');
    }
};
