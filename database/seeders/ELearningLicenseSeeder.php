<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ELearningLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenses = [
            [
                'name' => 'ACT Awareness',
               // 'registration_id' => 'reg_ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65_66f3f3472813b',
                'course_id' => 'ACTAwarenesse-learningSCORM1.2v5.0.3d226061b-ad18-4173-b78f-bf66574cfe65',
               // 'course_link' => 'https://cloud.scorm.com/api/cloud/registration/launch/234399fc-5f5a-418c-bf25-4a7112f755aa',
            ],
            [
                'name' => 'ACT Security',
               // 'registration_id' => 'reg_ACTE-LearningSecurityv1.0.3SCORM1.29e3b7612-c825-4cc0-a546-a97b1c6cf5ba_66f3f347d857e',
                'course_id' => 'ACTE-LearningSecurityv1.0.3SCORM1.29e3b7612-c825-4cc0-a546-a97b1c6cf5ba',
                //'course_link' => 'https://cloud.scorm.com/api/cloud/registration/launch/e6d858fd-3c7b-4f29-af52-def093b13e27',
            ],
            ['name' => 'First Aid at Work', 'course_id' => null],
            [
                'name' => 'Emergency First Aid at Work',
                'course_id' => 'HIGHFIELD_EMERGENCYFIRSTAIDATWORK_SINGLESCO_V1.5.3d48fbcc5-bcdd-4bc7-8657-817f52f26a7e',
            ],
            ['name' => 'Paediatric First Aid', 'course_id' => null],
            ['name' => 'Introduction to Fire Safety at the Workplace', 'course_id' => null],
            ['name' => 'Awareness of Modern Slavery', 'course_id' => null],
            ['name' => 'Equality and Diversity', 'course_id' => null],
            ['name' => 'General Data Protection Regulation (GDPR)', 'course_id' => null],
            ['name' => 'Manual Handling', 'course_id' => null],
            ['name' => 'Food Safety in Manufacturing', 'course_id' => null],
            ['name' => 'Food Safety Level 3', 'course_id' => null],
            ['name' => 'Food Safety Level 2', 'course_id' => null],
            ['name' => 'Food Safety Level 1', 'course_id' => null],
            ['name' => 'Customer Service', 'course_id' => null],
            ['name' => 'An Awareness of Warehousing and Storage', 'course_id' => null],
            ['name' => 'Principles of the Role of a Fire Marshall', 'course_id' => null],
            ['name' => 'Introduction to Working at Height', 'course_id' => null],
            ['name' => 'Asbestos Awareness', 'course_id' => null],
            ['name' => 'Health and Safety in a Construction Environment ', 'course_id' => null],
        ];

        // Insert each license into the database
        foreach ($licenses as $license) {
            DB::table('licenses')->insert([
                'name' => $license['name'],
                'course_id' => $license['course_id'],
            ]);
        }
    }
}
