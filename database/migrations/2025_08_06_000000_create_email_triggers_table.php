<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('email_triggers', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('reminder_type')->nullable();
            $table->string('type')->nullable();
            $table->string('reminder_time')->nullable();
            $table->boolean('trainer_assigned')->default(false);
            $table->unsignedBigInteger('email_template_id');
            $table->foreign('email_template_id')->references('id')->on('email_templates')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('email_triggers');
    }
};
