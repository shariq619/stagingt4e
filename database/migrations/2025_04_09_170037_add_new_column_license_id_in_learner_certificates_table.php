<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnLicenseIdInLearnerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learner_certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('license_id')->nullable(); // Cohort ID (optional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learner_certificates', function (Blueprint $table) {
            $table->dropColumn('license_id');
        });
    }
}
