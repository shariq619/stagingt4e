<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'name' => 'English Assessment',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'PI Health Questioner',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Activity Sheet',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'CCTV Activity Sheet',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Top-Up Workbook',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'SG Top-Up Workbook',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'PI Techniques Questionnaire',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Course Start Date Reminder',
                'type' => 'Reminders',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Outstanding Tasks Reminder',
                'type' => 'Reminders',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Qualification Expire Reminder',
                'type' => 'Reminders',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Course Evaluation Form',
                'type' => 'PostCompletion',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
//            [
//                'name' => 'Rate Us Online',
//                'type' => 'PostCompletion',
//                'task_code' => '',
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//            [
//                'name' => 'Qualification Expire Reminder',
//                'type' => 'PostCompletion',
//                'task_code' => '',
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
            [
                'name' => 'DS Top-Up Textbook',
                'type' => 'CourseWork',
                'task_code' => 'resources/DStopupselfstudytexbook.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'SG Top-Up Textbook',
                'type' => 'CourseWork',
                'task_code' => 'resources/SGtop-up-textbook.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Distance Learning Booklet',
                'type' => 'CourseWork',
                'task_code' => 'resources/DistanceLearningBooklet_DS_2023.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'CCTV Distance Learning Booklet',
                'type' => 'CourseWork',
                'task_code' => 'resources/DistanceLearningBooklet_CCTV_2023_V11.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Refresher WorkBook Unit 1',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Refresher WorkBook Unit 2',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DS Refresher Coursebook',
                'type' => 'CourseWork',
                'task_code' => 'resources/DS REFRESHER_Coursebook.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Security Guard Course book',
                'type' => 'CourseWork',
                'task_code' => 'resources/Security Guard REFRESHER_Workbook.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Security Guard Refresher Workbook',
                'type' => 'CourseWork',
                'task_code' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];


        foreach ($tasks as $task) {
            DB::table('tasks')->insert([
                'name' => $task, // Capitalize the first letter
            ]);
        }
    }
}
