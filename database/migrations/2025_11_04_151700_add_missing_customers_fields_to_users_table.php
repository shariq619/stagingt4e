<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'work_email')) {
                $table->string('work_email')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'unknown_delegate_name')) {
                $table->string('unknown_delegate_name')->nullable()->after('work_email');
            }
            if (!Schema::hasColumn('users', 'house_number')) {
                $table->string('house_number', 64)->nullable()->after('mobile');
            }
            if (!Schema::hasColumn('users', 'house_name')) {
                $table->string('house_name', 128)->nullable()->after('house_number');
            }
            if (!Schema::hasColumn('users', 'years_at_address')) {
                $table->string('years_at_address', 16)->nullable()->after('house_name');
            }
            if (!Schema::hasColumn('users', 'town')) {
                $table->string('town', 128)->nullable()->after('years_at_address');
            }
            if (!Schema::hasColumn('users', 'county')) {
                $table->string('county', 128)->nullable()->after('town');
            }
            if (!Schema::hasColumn('users', 'postal_code')) {
                $table->string('postal_code', 32)->nullable()->after('county');
            }
            if (!Schema::hasColumn('users', 'postcode')) {
                $table->string('postcode', 32)->nullable()->after('postal_code');
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality', 128)->nullable()->after('postcode');
            }
            if (!Schema::hasColumn('users', 'job_title')) {
                $table->string('job_title', 191)->nullable()->after('nationality');
            }
            if (!Schema::hasColumn('users', 'job_type')) {
                $table->string('job_type', 191)->nullable()->after('job_title');
            }
            if (!Schema::hasColumn('users', 'ni_number')) {
                $table->string('ni_number', 64)->nullable()->after('job_type');
            }
            if (!Schema::hasColumn('users', 'hours_worked')) {
                $table->string('hours_worked', 32)->nullable()->after('ni_number');
            }
            if (!Schema::hasColumn('users', 'third_party_reference')) {
                $table->string('third_party_reference', 32)->nullable()->after('hours_worked');
            }
            if (!Schema::hasColumn('users', 'funder')) {
                $table->string('funder', 32)->nullable()->after('third_party_reference');
            }
            if (!Schema::hasColumn('users', 'start_date')) {
                $table->date('start_date')->nullable()->after('funder');
            }
            if (!Schema::hasColumn('users', 'payroll_reference')) {
                $table->string('payroll_reference', 128)->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('users', 'salutation')) {
                $table->string('salutation', 64)->nullable()->after('payroll_reference');
            }
            if (!Schema::hasColumn('users', 'vle')) {
                $table->string('vle', 191)->nullable()->after('salutation');
            }
            if (!Schema::hasColumn('users', 'external_login')) {
                $table->boolean('external_login')->nullable()->after('vle');
            }
            if (!Schema::hasColumn('users', 'exclude_from_level_check')) {
                $table->boolean('exclude_from_level_check')->nullable()->after('external_login');
            }
            if (!Schema::hasColumn('users', 'customer_id')) {
                $table->string('customer_id', 64)->nullable()->after('exclude_from_level_check');
            }
            if (!Schema::hasColumn('users', 'owner_id')) {
                $table->string('owner_id', 64)->nullable()->after('customer_id');
            }
            if (!Schema::hasColumn('users', 'source')) {
                $table->string('source', 191)->nullable()->after('owner_id');
            }
            if (!Schema::hasColumn('users', 'staff_link')) {
                $table->string('staff_link', 191)->nullable()->after('source');
            }
            if (!Schema::hasColumn('users', 'learner_delegate_type')) {
                $table->string('learner_delegate_type', 191)->nullable()->after('staff_link');
            }
            if (!Schema::hasColumn('users', 'old_reference')) {
                $table->string('old_reference', 191)->nullable()->after('learner_delegate_type');
            }
            if (!Schema::hasColumn('users', 'work_tel')) {
                $table->string('work_tel', 64)->nullable()->after('telephone');
            }
            if (!Schema::hasColumn('users', 'notes')) {
                $table->text('notes')->nullable()->after('work_tel');
            }
            if (!Schema::hasColumn('users', 'learner_status')) {
                $table->enum('learner_status', [
                    'Cancelled','Confirmed','Drop-Out','Failed','HSA Resit',
                    'No Show','Non-Attendance','Passed','Provisional','Transferred'
                ])->nullable()->after('image');
            }
            if (!Schema::hasColumn('users', 'birth_date')) {
                $table->string('birth_date')->nullable()->after('birth_place');
            }
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable()->after('website');
            }
            if (!Schema::hasColumn('users', 'mobile')) {
                $table->string('mobile')->nullable()->after('telephone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = [
                'last_name', 'work_email', 'unknown_delegate_name', 'house_number',
                'house_name', 'years_at_address', 'town', 'county', 'postal_code',
                'postcode', 'nationality', 'job_title', 'job_type', 'ni_number',
                'hours_worked', 'third_party_reference', 'funder', 'start_date',
                'payroll_reference', 'salutation', 'vle', 'external_login',
                'exclude_from_level_check', 'customer_id', 'owner_id', 'source',
                'staff_link', 'learner_delegate_type', 'old_reference', 'work_tel',
                'notes',
            ];

            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
