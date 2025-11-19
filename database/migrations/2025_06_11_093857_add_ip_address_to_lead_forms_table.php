<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpAddressToLeadFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_forms', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->after('notes'); // IPv6-compatible
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_forms', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
}
