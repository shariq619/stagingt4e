<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('name');
                $table->tinyInteger('user_id')->nullable();
                $table->decimal('price', 8, 2);
                $table->decimal('discount_price', 8, 2)->nullable();
                $table->string('product_image')->nullable();
                $table->json('gallery')->nullable();
                $table->text('excerpt')->nullable();
                $table->text('short_description')->nullable();
                $table->text('description')->nullable();
                $table->text('description_two')->nullable();
                $table->text('description_three')->nullable();
                $table->text('description_four')->nullable();
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
