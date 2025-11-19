<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $lastColumn = 'otp_expiry';

            $addString = function ($name, $length = 255) use ($table, &$lastColumn) {
                if (!Schema::hasColumn('users', $name)) {
                    $table->string($name, $length)->nullable()->after($lastColumn);
                    $lastColumn = $name;
                }
            };

            $addText = function ($name) use ($table, &$lastColumn) {
                if (!Schema::hasColumn('users', $name)) {
                    $table->text($name)->nullable()->after($lastColumn);
                    $lastColumn = $name;
                }
            };

            $addDate = function ($name) use ($table, &$lastColumn) {
                if (!Schema::hasColumn('users', $name)) {
                    $table->date($name)->nullable()->after($lastColumn);
                    $lastColumn = $name;
                }
            };

            $addString('learner_status');
            $addString('telephone');
            $addString('phone_number');
            $addString('mobile');
            $addString('work_email');
            $addString('address', 512);
            $addString('house_number', 64);
            $addString('house_name', 128);
            $addString('years_at_address', 16);
            $addString('town', 128);
            $addString('county', 128);
            $addString('postal_code', 32);
            $addString('postcode', 32);
            $addDate('birth_date');
            $addString('nationality', 128);
            $addString('job_title', 191);
            $addString('job_type', 191);
            $addString('ni_number', 64);
            $addString('hours_worked', 32);
            $addString('third_party_reference', 32);
            $addString('funder', 32);
            $addDate('start_date');


            $addString('payroll_reference', 128);
            $addString('salutation', 64);
            $addString('vle', 191);

            if (!Schema::hasColumn('users', 'external_login')) {
                $table->boolean('external_login')->nullable()->after($lastColumn);
                $lastColumn = 'external_login';
            }

            if (!Schema::hasColumn('users', 'exclude_from_level_check')) {
                $table->boolean('exclude_from_level_check')->nullable()->after($lastColumn);
                $lastColumn = 'exclude_from_level_check';
            }


            $addString('customer_id', 64);
            $addString('owner_id', 64);
            $addString('source', 191);
            $addString('staff_link', 191);
            $addString('learner_delegate_type', 191);

            $addString('unknown_delegate_name', 191);
            $addString('old_reference', 191);
            $addString('work_tel', 64);
            $addText('notes');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = [
                'learner_status','telephone','phone_number','mobile','work_email',
                'address','house_number','house_name','years_at_address',
                'town','county','postal_code','postcode',
                'birth_date','nationality','job_title','job_type','ni_number',
                'hours_worked','payroll_reference','salutation',
                'vle','external_login','customer_id','owner_id','source',
                'unknown_delegate_name','old_reference','work_tel','notes',
                'third_party_reference', 'funder', 'staff_link', 'learner_delegate_type', 'start_date', 'exclude_from_level_check'
            ];
            foreach ($cols as $c) {
                if (Schema::hasColumn('users', $c)) {
                    $table->dropColumn($c);
                }
            }
        });
    }
};
