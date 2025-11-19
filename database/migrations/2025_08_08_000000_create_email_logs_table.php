<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->string('subject');
            $table->longText('body');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('trigger_id')->nullable();
            $table->string('mailable_type')->nullable(); // Model class name
            $table->unsignedBigInteger('mailable_id')->nullable(); // Model record id
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('email_logs');
    }
};
