<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_testimonials', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->index();

            $table->string('title', 150)->nullable();
            $table->text('message')->nullable();

            $table->string('video_disk', 50)->default('public');
            $table->string('video_path');
            $table->string('thumbnail_path')->nullable();

            $table->string('video_format', 20)->nullable();
            $table->unsignedInteger('video_duration')->nullable();
            $table->unsignedBigInteger('video_size')->nullable();

            $table->boolean('consent_given')->default(false);
            $table->text('consent_text');
            $table->string('consent_version', 20)->nullable();
            $table->timestamp('consent_at')->nullable();
            $table->string('ip_address', 45)->nullable();

            $table->string('status', 20)->default('pending');

            $table->integer('reviewed_by')->nullable()->index('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();

            $table->boolean('is_public')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->json('tags')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'consent_given']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_testimonials');
    }
};
