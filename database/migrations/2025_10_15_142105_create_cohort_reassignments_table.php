<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cohort_reassignments', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('from_cohort_id');
            $table->integer('to_cohort_id');

            $table->integer('order_detail_id')->nullable();
            $table->integer('product_invoice_id')->nullable();

            $table->decimal('fee_net', 12, 2)->default(0);
            $table->decimal('vat_rate', 8, 2)->default(0);
            $table->decimal('fee_vat', 12, 2)->default(0);
            $table->decimal('fee_gross', 12, 2)->default(0);

            $table->boolean('included_in_invoice')->default(false);
            $table->string('invoice_line_code', 50)->nullable();
            $table->string('invoice_line_desc', 255)->nullable();
            $table->integer('created_by')->nullable();
            $table->json('meta')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'from_cohort_id', 'to_cohort_id']);
            $table->index(['order_detail_id']);
            $table->index(['product_invoice_id']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cohort_reassignments');
    }
};

