<?php

// database/migrations/2025_10_09_000120_create_sources_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sources', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('name')->nullable();
            $t->string('contact')->nullable();
            $t->string('telephone')->nullable();
            $t->string('email')->nullable();
            $t->string('postcode')->nullable();
            $t->string('status', 16)->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sources');
    }
};

