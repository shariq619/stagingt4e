<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('crm_stripe_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('context', 40)->index();
            $table->integer('invoice_id')->index()->nullable()->index();
            $table->string('payment_intent', 64)->nullable()->index();
            $table->string('charge_id', 64)->nullable()->index();
            $table->string('refund_id', 64)->nullable()->index();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('currency', 10)->nullable();
            $table->string('status', 40)->nullable()->index();
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_stripe_payment_logs');
    }
};
