<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('front_orders')->onDelete('cascade');

            $table->tinyInteger('is_bundle')->default(false); // 0 courses 1 bundle 2 products
            $table->json('courses')->nullable(); // Store selected courses as JSON

            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('cohort_id')->nullable();
            $table->bigInteger('bundle_id')->nullable();
            $table->bigInteger('product_id')->nullable();

            $table->string('course_name');
            $table->decimal('course_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);

            $table->decimal('deposit_paid', 10, 2)->nullable();
            $table->decimal('deposit_amount', 10, 2)->nullable();
            $table->decimal('remaining_balance', 10, 2)->nullable();



            $table->decimal('discount', 10, 2)->default(0);
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
        Schema::dropIfExists('front_order_details');
    }
}
