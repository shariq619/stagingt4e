<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_bundles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('bundle_image')->nullable();
            $table->string('name');
            $table->string('products');
            $table->text('short_description')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('courses_included')->nullable();
            $table->decimal('regular_price', 8, 2);
            $table->decimal('vat', 8, 2)->nullable();
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
        Schema::dropIfExists('course_bundles');
    }
}
