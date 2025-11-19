<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->dropColumn('vat');
        });

        Schema::table('front_order_details', function (Blueprint $table) {
            $table->decimal('vat', 10, 2)->nullable()->after('total_price');
        });
    }

    public function down(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->dropColumn('vat');
        });

        DB::statement("ALTER TABLE front_order_details ADD COLUMN vat DECIMAL(10,2) GENERATED ALWAYS AS (total_price * 0.20) STORED");
    }
};
