<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMappingConditionsTable extends Migration
{
    public function up()
    {
        Schema::create('email_mapping_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mapping_id')->index();
            $table->string('key');
            $table->string('operator')->default('eq');
            $table->string('value')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('email_mapping_conditions');
    }
}
