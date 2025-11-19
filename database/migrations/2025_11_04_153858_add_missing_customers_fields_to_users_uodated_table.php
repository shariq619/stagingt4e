<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'address2')) {
                $table->string('address2', 255)->nullable()->after('address');
            }

            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country', 128)->nullable()->after('county');
            }

            if (!Schema::hasColumn('users', 'customer_group')) {
                $table->string('customer_group', 191)->nullable()->after('company');
            }

            if (!Schema::hasColumn('users', 'currency')) {
                $table->string('currency', 16)->nullable()->after('customer_group');
            }

            if (!Schema::hasColumn('users', 'fax')) {
                $table->string('fax', 64)->nullable()->after('telephone');
            }

            if (!Schema::hasColumn('users', 'staff_code')) {
                $table->string('staff_code', 64)->nullable()->after('staff_link');
            }

            if (!Schema::hasColumn('users', 'supervisor_confirmer')) {
                $table->string('supervisor_confirmer', 191)->nullable()->after('staff_code');
            }

            if (!Schema::hasColumn('users', 'source_affiliate')) {
                $table->string('source_affiliate', 191)->nullable()->after('source');
            }

            if (!Schema::hasColumn('users', 'source_campaign')) {
                $table->string('source_campaign', 191)->nullable()->after('source_affiliate');
            }

            if (!Schema::hasColumn('users', 'b2b_customer')) {
                $table->boolean('b2b_customer')->nullable()->after('company');
            }

            if (!Schema::hasColumn('users', 'ct_cctv')) {
                $table->boolean('ct_cctv')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('users', 'ct_close_protection')) {
                $table->boolean('ct_close_protection')->nullable()->after('ct_cctv');
            }
            if (!Schema::hasColumn('users', 'ct_cscs')) {
                $table->boolean('ct_cscs')->nullable()->after('ct_close_protection');
            }
            if (!Schema::hasColumn('users', 'ct_door_supervisor')) {
                $table->boolean('ct_door_supervisor')->nullable()->after('ct_cscs');
            }
            if (!Schema::hasColumn('users', 'ct_fire_marshall')) {
                $table->boolean('ct_fire_marshall')->nullable()->after('ct_door_supervisor');
            }
            if (!Schema::hasColumn('users', 'ct_first_aid')) {
                $table->boolean('ct_first_aid')->nullable()->after('ct_fire_marshall');
            }
            if (!Schema::hasColumn('users', 'ct_vehicle_banksman')) {
                $table->boolean('ct_vehicle_banksman')->nullable()->after('ct_first_aid');
            }

            if (!Schema::hasColumn('users', 'pm_letter')) {
                $table->boolean('pm_letter')->nullable()->after('ct_vehicle_banksman');
            }
            if (!Schema::hasColumn('users', 'pm_email')) {
                $table->boolean('pm_email')->nullable()->after('pm_letter');
            }
            if (!Schema::hasColumn('users', 'pm_sms')) {
                $table->boolean('pm_sms')->nullable()->after('pm_email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = [
                'address2',
                'country',
                'customer_group',
                'currency',
                'fax',
                'staff_code',
                'supervisor_confirmer',
                'source_affiliate',
                'source_campaign',
                'b2b_customer',
                'ct_cctv',
                'ct_close_protection',
                'ct_cscs',
                'ct_door_supervisor',
                'ct_fire_marshall',
                'ct_first_aid',
                'ct_vehicle_banksman',
                'pm_letter',
                'pm_email',
                'pm_sms',
            ];

            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
