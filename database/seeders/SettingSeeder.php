<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        Setting::create([
            'name' => 'Training4employment',
            'logo' => 'logo/default.png',
            'email' => 'info@training4employment.co.uk',
            'phone_number' => '0121 630 2115',
            'address' => 'Head Office: 89-91 Hatchett Street, Birmingham, West Midlands, B19 3NY',
            'facebook' => 'https://facebook.com',
            'youtube' => 'https://youtube.com',
            'instagram' => 'https://instagram.com',
            // 'twitter ' => 'https://twitter.com'
        ]);
    }
}
