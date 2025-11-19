<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $venues = [
            [
                'venue_name' => 'Birmingham',
                'slug' => Str::slug('Birmingham'),
                'address' => '89-91 Hatchett Street, Birmingham, West Midlands',
                'city' => 'Birmingham',
                'post_code' => 'B19 3NY',
            ],
            [
                'venue_name' => 'Leicester',
                'slug' => Str::slug('Leicester'),
                'address' => 'Arts Centre Garden Street Leicester',
                'city' => 'Leicester',
                'post_code' => 'LE1 3UA',
            ],
            [
                'venue_name' => 'Nottingham',
                'slug' => Str::slug('Nottingham'),
                'address' => '296 Mansfield Road, Nottingham',
                'city' => 'Nottingham',
                'post_code' => 'NG5 2BT',
            ],
            [
                'venue_name' => 'London',
                'slug' => Str::slug('London'),
                'address' => 'Rays House, North Circular Road, NW10 7XP',
                'city' => 'London',
                'post_code' => 'NW10 7XP',
            ],
            [
                'venue_name' => 'Manchester',
                'slug' => Str::slug('Manchester'),
                'address' => '-',
                'city' => 'Manchester',
                'post_code' => '',
            ],
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}
