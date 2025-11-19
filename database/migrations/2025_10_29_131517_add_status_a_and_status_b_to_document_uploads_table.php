<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAAndStatusBToDocumentUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_uploads', function (Blueprint $table) {
            $table->enum('status_a', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted')
                ->nullable()
                ->after('comments');

            $table->enum('status_b', ['In Progress', 'Not Submitted', 'Approved', 'Rejected'])->default('Not Submitted')
                ->nullable()
                ->after('status_a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_uploads', function (Blueprint $table) {
            //
        });
    }
}
