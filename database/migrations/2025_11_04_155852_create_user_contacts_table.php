<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->string('name', 255)->nullable();
            $table->string('position', 255)->nullable();
            $table->string('direct_number', 100)->nullable();
            $table->string('direct_email', 255)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->boolean('opt_out')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_contacts');
    }
};
