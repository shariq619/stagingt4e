<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Trainer',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Learner',
            'guard_name' => 'web'
        ]);


        Role::create([
            'name' => 'Corporate Client',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'SEO',
            'guard_name' => 'web'
        ]);
    }
}
