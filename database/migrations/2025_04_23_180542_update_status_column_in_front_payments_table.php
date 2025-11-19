<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInFrontPaymentsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE front_payments MODIFY status ENUM('pending', 'completed', 'failed', 'Refund') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE front_payments MODIFY status ENUM('pending', 'completed', 'failed') DEFAULT 'pending'");
    }
}
