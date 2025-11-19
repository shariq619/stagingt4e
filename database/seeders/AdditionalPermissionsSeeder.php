<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalPermissionsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Reseller-specific permissions
        $resellerPermissions = [
            [
                'name' => 'see reseller',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'add reseller',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'change reseller',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'delete reseller',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        // Insert only non-existing permissions
        foreach ($resellerPermissions as $permission) {
            $exists = DB::table('permissions')
                ->where('name', $permission['name'])
                ->exists();

            if (!$exists) {
                DB::table('permissions')->insert($permission);
            }
        }

    }
}
