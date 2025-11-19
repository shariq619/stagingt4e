<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('cohort_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_amount', 10, 2);  // Total cost of the course
            $table->decimal('amount_paid', 10, 2)->default(0); // Amount paid so far
            $table->enum('payment_type', ['full', 'deposit'])->default('full');  // Full payment or deposit
            $table->enum('status', ['pending', 'partially_paid', 'completed', 'cancelled'])->default('pending');
            $table->string('order_type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
