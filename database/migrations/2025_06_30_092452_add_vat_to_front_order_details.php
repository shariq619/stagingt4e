<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVatToFrontOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->decimal('cost_price', 10, 2)->nullable()->after('course_name');
            $table->decimal('vat', 10, 2)->nullable()->after('cost_price');
            $table->string('invoice_pdf_url')->nullable()->after('discount');
            $table->string('invoice_number')->nullable()->after('invoice_pdf_url');
            $table->enum('status', ['Pending', 'Zero Paid', 'Partially Paid', 'Overdue', 'Paid'])->default('Pending')->after('invoice_number');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->dropColumn(['vat', 'cost_price','invoice_pdf_url', 'invoice_number', 'status']);
        });
    }
}
