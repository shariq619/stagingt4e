<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable()->after('order_id');

        });
    }

    public function down(): void
    {
        Schema::table('front_order_details', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
