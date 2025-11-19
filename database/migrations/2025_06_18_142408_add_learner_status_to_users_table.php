<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLearnerStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('learner_status', ['Cancelled', 'Confirmed', 'Drop-Out', 'Failed', 'HSA Resit', 'No Show', 'Non-Attendance', 'Passed', 'Provisional - Admin Staff to follow up', 'Transferred'])->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('learner_status');
        });
    }
}
