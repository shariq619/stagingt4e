<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
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
                'name' => 'Emergency First Aid at Work',
            ],
            [
                'name' => 'First Aid at Work',
            ],
            [
                'name' => 'Any other valid first aid qualification',
            ]
        ];

        foreach ($venues as $venue) {
            Certification::create($venue);
        }
    }
}
