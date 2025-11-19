<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCertificationIdNullableAndAddIsSkipToUserCertificationsTable extends Migration
{
public function up()
    {
        Schema::table('user_certifications', function (Blueprint $table) {
            $table->dropForeign(['certification_id']);
        });

        DB::statement('ALTER TABLE user_certifications MODIFY certification_id BIGINT UNSIGNED NULL');

        Schema::table('user_certifications', function (Blueprint $table) {
            $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('cascade');
        });

        Schema::table('user_certifications', function (Blueprint $table) {
            $table->boolean('is_skip')->nullable()->after('course_certificate');
        });
    }

    public function down()
    {
        Schema::table('user_certifications', function (Blueprint $table) {
            $table->dropForeign(['certification_id']);
            $table->dropColumn('is_skip');
        });

        DB::statement('ALTER TABLE user_certifications MODIFY certification_id BIGINT UNSIGNED NOT NULL');

        Schema::table('user_certifications', function (Blueprint $table) {
            $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('cascade');
        });
    }
}
