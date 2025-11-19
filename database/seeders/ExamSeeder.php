<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('exams')->insert([
//            ['name' => 'Principles of working in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:15:38', 'updated_at' => '2024-07-25 22:15:38', 'deleted_at' => NULL],
//            ['name' => 'Principles of working as a Door Supervisor in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:15:43', 'updated_at' => '2024-07-25 22:15:43', 'deleted_at' => NULL],
//            ['name' => 'Application of conflict management in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:15:49', 'updated_at' => '2024-07-25 22:15:49', 'deleted_at' => NULL],
//            ['name' => 'Application of physical intervention skills in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:15:54', 'updated_at' => '2024-07-25 22:15:54', 'deleted_at' => NULL],
//            ['name' => 'Principles of Terror Threat Awareness in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:00', 'updated_at' => '2024-07-25 22:16:00', 'deleted_at' => NULL],
//            ['name' => 'Principles of Using Equipment as a Door Supervisor in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:06', 'updated_at' => '2024-07-25 22:16:06', 'deleted_at' => NULL],
//            ['name' => 'Principles and Practices of Working as a CCTV Operator in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:11', 'updated_at' => '2024-07-25 22:16:11', 'deleted_at' => NULL],
//            ['name' => 'Principles of Minimising Personal Risk for Security Officers in the Private Security Industry', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:16', 'updated_at' => '2024-07-25 22:16:16', 'deleted_at' => NULL],
//            ['name' => 'Emergency First Aid in the Workplace', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:20', 'updated_at' => '2024-07-25 22:16:20', 'deleted_at' => NULL],
//            ['name' => 'Managing paediatric illness, injuries and emergencies', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:26', 'updated_at' => '2024-07-25 22:16:26', 'deleted_at' => NULL],
//            ['name' => 'Emergency Paediatric First Aid', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:30', 'updated_at' => '2024-07-25 22:16:30', 'deleted_at' => NULL],
//            ['name' => 'Recognition and Management of Illness and Injury in the Workplace', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:36', 'updated_at' => '2024-07-25 22:16:36', 'deleted_at' => NULL],
//            ['name' => 'Health and safety in a construction environment', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:40', 'updated_at' => '2024-07-25 22:16:40', 'deleted_at' => NULL],
//            ['name' => 'Legal and Social Responsibilities of a Personal License Holder', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:45', 'updated_at' => '2024-07-25 22:16:45', 'deleted_at' => NULL],
//            ['name' => 'Principles of Fire Safety', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:51', 'updated_at' => '2024-07-25 22:16:51', 'deleted_at' => NULL],
//            ['name' => 'Principles of Fire Safety Awareness', 'user_id' => 1, 'created_at' => '2024-07-25 22:16:56', 'updated_at' => '2024-07-25 22:16:56', 'deleted_at' => NULL],
//            ['name' => 'Traffic Marshal', 'user_id' => 1, 'created_at' => '2024-07-25 23:21:39', 'updated_at' => '2024-07-25 23:21:39', 'deleted_at' => NULL],
//            ['name' => 'First Aid', 'user_id' => 1, 'created_at' => '2024-07-26 02:05:34', 'updated_at' => '2024-07-26 02:05:34', 'deleted_at' => NULL],
//            ['name' => 'Fire Safety level 2', 'user_id' => 1, 'created_at' => '2024-07-26 02:16:43', 'updated_at' => '2024-07-26 02:16:43', 'deleted_at' => NULL],
//            ['name' => 'Legal and management', 'user_id' => 1, 'created_at' => '2024-07-26 19:41:20', 'updated_at' => '2024-07-26 19:41:20', 'deleted_at' => NULL],
//            ['name' => 'Health and welfare', 'user_id' => 1, 'created_at' => '2024-07-26 19:41:33', 'updated_at' => '2024-07-26 19:41:33', 'deleted_at' => NULL],
//            ['name' => 'General safety', 'user_id' => 1, 'created_at' => '2024-07-26 19:41:47', 'updated_at' => '2024-07-26 19:41:47', 'deleted_at' => NULL],
//            ['name' => 'High risk activities', 'user_id' => 1, 'created_at' => '2024-07-26 19:42:08', 'updated_at' => '2024-07-26 19:42:08', 'deleted_at' => NULL],
//            ['name' => 'Environment', 'user_id' => 1, 'created_at' => '2024-07-26 19:42:20', 'updated_at' => '2024-07-26 19:42:20', 'deleted_at' => NULL],
//
//            // New exams to be added
//            ['name' => '(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – MCQ', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//            ['name' => '(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – Practical', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//            ['name' => '(D/651/3643) Principles of Working as a Door Supervisor in the Private Security Industry (Refresher) – MCQ', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//            ['name' => '(D/651/3643) Principles of Working as a Door Supervisor in the Private Security Industry (Refresher) - Practical', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//
//            // Adding the two new exams you requested
//            ['name' => '(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – MCQ', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//            ['name' => '(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – Practical', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => NULL],
//
//
//
//        ]);



        $exams = [
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – MCQ', 'min_score' => 24, 'max_score' => 30, 'pass_rate' => '80'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(F/651/3644) Application of Physical Intervention Skills in the Private Security Industry (Refresher) – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '80'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(D/651/3643) Principles of Working as a Door Supervisor in the Private Security Industry (Refresher) – MCQ', 'min_score' => 24.85, 'max_score' => 35, 'pass_rate' => '71'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(D/651/3643) Principles of Working as a Door Supervisor in the Private Security Industry (Refresher) - Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – MCQ', 'min_score' => 19.88, 'max_score' => 28, 'pass_rate' => '71'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(H/651/3645) Principles of Working as a Security Officer in the Private Security Industry (Refresher) – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],

            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(J/617/9686) Principles of working in the private security industry – MCQ', 'min_score' => 50.4, 'max_score' => 72, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(J/617/9686) Principles of working in the private security industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(R/617/9691) Principles and Practices of Working as a CCTV Operator in the Private Security Industry – MCQ', 'min_score' => 28, 'max_score' => 40, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(R/617/9691) Principles and Practices of Working as a CCTV Operator in the Private Security Industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(M/618/6843) Principles of Terror Threat Awareness in the Private Security Industry – MCQ', 'min_score' => 7, 'max_score' => 10, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(T/618/6844) Principles of Using Equipment as a Door Supervisor in the Private Security Industry – MCQ', 'min_score' => 3.5, 'max_score' => 5, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(T/618/6844) Principles of Using Equipment as a Door Supervisor in the Private Security Industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(Y/617/9689) Application of physical intervention skills in the private security industry – MCQ', 'min_score' => 24, 'max_score' => 30, 'pass_rate' => '80'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(Y/617/9689) Application of physical intervention skills in the private security industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(F/618/6846) Principles of Minimising Personal Risk for Security Officers in the Private Security Industry – MCQ', 'min_score' => 11.2, 'max_score' => 16, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(L/617/9687) Principles of working as a door supervisor in the private security industry – MCQ', 'min_score' => 35, 'max_score' => 50, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(L/617/9687) Principles of working as a door supervisor in the private security industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'Security', 'type' => 'MCQ' , 'name' => '(R/617/9688) Application of conflict management in the private security industry – MCQ', 'min_score' => 14, 'max_score' => 20, 'pass_rate' => '70'],
            ['industry' => 'Security', 'type' => 'Practical' , 'name' => '(R/617/9688) Application of conflict management in the private security industry – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'First Aid', 'type' => 'MCQ' , 'name' => 'A/650/2021 Emergency First Aid in the Workplace – MCQ', 'min_score' => 11, 'max_score' => 15, 'pass_rate' => '70'],
            ['industry' => 'First Aid', 'type' => 'Practical' , 'name' => 'A/650/2021 Emergency First Aid in the Workplace – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],
            ['industry' => 'First Aid', 'type' => 'MCQ' , 'name' => 'A/650/2021 Emergency First Aid in the Workplace and D/650/2022 Recognition and Management of Illness and Injury in the Workplace – MCQ', 'min_score' => 21, 'max_score' => 30, 'pass_rate' => '70'],
            ['industry' => 'First Aid', 'type' => 'Practical' , 'name' => 'A/650/2021 Emergency First Aid in the Workplace and D/650/2022 Recognition and Management of Illness and Injury in the Workplace – Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],

            ['industry' => 'First Aid', 'type' => 'MCQ' , 'name' => '(F/650/2023) Emergency Paediatric First Aid - MCQ', 'min_score' => 23, 'max_score' => 33, 'pass_rate' => '100'],
            ['industry' => 'First Aid', 'type' => 'Practical' , 'name' => '(H/650/2024) Emergency Paediatric First Aid - Practical', 'min_score' => 100, 'max_score' => 100, 'pass_rate' => '100'],

            ['industry' => 'Construction', 'type' => 'MCQ' , 'name' => '(M/616/4115) Health and safety in a construction environment – MCQ', 'min_score' => 32, 'max_score' => 40, 'pass_rate' => '80'],
            ['industry' => 'Fire Safety', 'type' => 'MCQ' , 'name' => '(K/615/7535) Principles of Fire Safety – MCQ', 'min_score' => 12, 'max_score' => 20, 'pass_rate' => '60'],

            ['industry' => 'Construction','name' => 'Health and Safety Awareness (HSA)', 'min_score' => 25, 'max_score' => 30, 'pass_rate' => '25'],


            ['industry' => 'Construction','name' => 'Site supervision safety training scheme - MCQ', 'min_score' => 24, 'max_score' => 30, 'pass_rate' => '24'],
            ['industry' => 'Construction','name' => 'Site supervision safety training scheme - Refresher', 'min_score' => 25, 'max_score' => 30, 'pass_rate' => '24'],
            ['industry' => 'Construction','name' => 'Site management safety training scheme  - MCQ', 'min_score' => 26, 'max_score' => 32, 'pass_rate' => '26'],
            ['industry' => 'Construction','name' => 'Site management safety training scheme - Refresher  - MCQ', 'min_score' => 26, 'max_score' => 32, 'pass_rate' => '26'],

            ['industry' => 'ALCOHOL','name' => '(L/616/6762) Personal Licence Holders (APLH) - MCQ', 'min_score' => 32, 'max_score' => 40, 'pass_rate' => '32'],
            ['industry' => 'Fire Safety','name' => '(K/615/75350) Principles of Fire Safety - MCQ', 'min_score' => 12, 'max_score' => 20, 'pass_rate' => '12'],
            ['industry' => 'Fire Safety','name' => '(Y/615/7451) Principles of Fire Safety Awareness - MCQ', 'min_score' => 9, 'max_score' => 15, 'pass_rate' => '9'],

            ['industry' => 'TRAFFIC MARSHALL, VEHICLE BANKSMAN','name' => 'Traffic Marshal, Vehicle Banksman - MCQ', 'min_score' => 0, 'max_score' => 0, 'pass_rate' => '0'],
            ['industry' => 'TRAFFIC MARSHALL, VEHICLE BANKSMAN','name' => 'Traffic Marshal, Vehicle Banksman - Practical', 'min_score' => 0, 'max_score' => 0, 'pass_rate' => '0'],


        ];

        foreach ($exams as $exam) {
            Exam::create($exam);
        }

    }
}
