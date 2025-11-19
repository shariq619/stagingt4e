<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insert parent categories
        DB::table('qualifications')->insert([
            ['name' => 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for CCTV Operators (Public Space Surveillance) in the Private Security Industry', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Top Up)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for Security Officers in the Private Security Industry (Top Up)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 3 Award in First Aid at Work', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 3 Award in Emergency First Aid at Work', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 3 Award in Paediatric First Aid', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 3 Award in Emergency Paediatric First Aid', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 1 Award in Health and Safety within a Construction Environment', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for Personal Licence Holders', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award in the Principles of Fire Safety', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 1 Award in the Principles of Fire Safety Awareness', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Refresher)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Highfield Level 2 Award for Security Officers in the Private Security Industry (Refresher)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Health and Safety Awareness (HSA)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Site supervision safety training scheme (SSSTS)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Site supervision safety training scheme - Refresher (SSSTS-R)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Site management safety training scheme (SMSTS)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Site management safety training scheme - Refresher (SMSTS-R)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Traffic Marshal, Vehicle Banksman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
