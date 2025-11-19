<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSeedInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Insert awarding bodies
//        DB::statement("
//            INSERT INTO `awarding_bodies` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
//            (1, 'Highfield Qualifications', 'We’re a global leader in compliance and work-based learning and apprenticeship qualifications and one of the UK’s most recognisable awarding organisations.', 1, '2024-07-25 22:11:56', '2024-07-25 22:11:56', NULL),
//            (2, 'CITB', 'CITB is the industry training board for the construction sector in England, Scotland, and Wales. It’s our job to help the construction industry attract talent and to support skills development, to build a better Britain.', 1, '2024-07-25 22:13:41', '2024-07-25 22:13:41', NULL);
//        ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
