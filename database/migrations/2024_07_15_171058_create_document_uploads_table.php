<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_option');
            $table->string('first_front_upload');
            $table->string('first_back_upload')->nullable();
            $table->string('second_option');
            $table->string('second_front_upload');
            $table->string('second_back_upload')->nullable();
            $table->string('third_front_upload');
            $table->string('third_back_upload')->nullable();
            $table->enum('status', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted');
            $table->text('comments')->nullable(); // Add comments column
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
        Schema::dropIfExists('document_uploads');
    }
}
