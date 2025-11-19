<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('slug')->nullable();
            $table->string('venue_name');
            $table->string('address');
            $table->string('post_code');
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('primary_contact_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('parking')->nullable();
            $table->text('access_instructions', 255)->nullable();
            $table->tinyInteger('user_id')->nullable();
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
        Schema::dropIfExists('venues');
    }
}
