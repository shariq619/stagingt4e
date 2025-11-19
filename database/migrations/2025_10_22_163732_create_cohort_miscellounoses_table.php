<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cohort_miscellounoses', function (Blueprint $table) {
            $table->id();
            $table->integer('cohort_id')->index();

            $table->string('nominal_code')->nullable();
            $table->string('description')->nullable();

            $table->decimal('cost', 10, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('net_cost', 10, 2)->default(0);
            $table->decimal('vat', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cohort_miscellounoses');
    }
};
