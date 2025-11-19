<?php

namespace Database\Seeders;

use App\Models\Methodology;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class MethodologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methodology = [
            [
                'name' => 'Ellite - Elite Academy of Security Training'
            ],
            [
                'name' => 'ESL - Eventure Security & Logistics Ltd'
            ]
        ];

        foreach ($methodology as $methodolog) {
            Methodology::create($methodolog);
        }
    }
}
