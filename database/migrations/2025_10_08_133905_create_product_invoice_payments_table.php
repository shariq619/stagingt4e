<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_invoice_payments', function (Blueprint $t) {
            $t->id();
            $t->integer('product_invoice_id');
            $t->string('payment_ref')->unique();
            $t->dateTime('payment_date');
            $t->string('payment_type', 40);
            $t->string('payment_from')->nullable();
            $t->decimal('amount', 12, 2);
            $t->json('meta')->nullable();
            $t->timestamps();

            $t->index(['product_invoice_id','payment_date']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('product_invoice_payments');
    }
};

