<?php

namespace Database\Seeders\CRM;

use App\Models\Lead;
use App\Models\User;
use App\Models\Course;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        Lead::Truncate();
        $faker = Factory::create();
        $statuses = array_keys(Lead::STATUSES);

        $users = User::role('Learner')->pluck('id')->toArray();
        $courses = Course::select('id', 'name')->get();

        $myDomains = ['just-in-service.com', 'takehouse.com', 'crm-t4e.com'];
        $commonDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];

        $cities = [
            'Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Peshawar', 'Multan',
            'Faisalabad', 'Hyderabad', 'Quetta', 'Sialkot'
        ];

        $platforms = ['WhatsApp', 'Facebook', 'Phone Call', 'Website', 'Instagram', 'LinkedIn'];
        $sources = ['Google Ads', 'Referral', 'Walk-in', 'Instagram', 'LinkedIn', 'Email Campaign'];

        $rows = [];

        for ($i = 1; $i <= 100; $i++) {
            $course = $courses->random();
            $status = Arr::random($statuses);

            $emailDomain = $faker->boolean(30)
                ? Arr::random($myDomains)
                : Arr::random($commonDomains);

            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $emailDomain);

            $hasEnrolled = $status === 'enrolled' && !empty($users);
            $userId = $hasEnrolled ? Arr::random($users) : null;
            $enrolmentDate = $hasEnrolled
                ? $faker->dateTimeBetween('-2 months', 'now')
                : null;

            $followUpAt = $faker->boolean(60)
                ? Carbon::parse($faker->dateTimeBetween('-10 days', '+10 days'))
                : null;

            $rows[] = [
                'contact_date'        => $faker->dateTimeBetween('-2 months', 'now'),
                'candidate_name'      => "$firstName $lastName",
                'contact_number'      => $faker->numerify('+92##########'),
                'email'               => $email,
                'course_interested'   => $course->name,
                'course_id'           => $course->id,
                'city'                => Arr::random($cities),
                'status'              => $status,
                'enrolment_date'      => $enrolmentDate,
                'platform'            => Arr::random($platforms),
                'source'              => Arr::random($sources),
                'notes'               => $faker->boolean(50)
                    ? $faker->sentence(10)
                    : null,
                'follow_up_at'        => $followUpAt,
                'follow_up2_at'       => $faker->boolean(30)
                    ? Carbon::parse($faker->dateTimeBetween('-5 days', '+5 days'))
                    : null,
                'follow_up_final_at'  => $faker->boolean(20)
                    ? Carbon::parse($faker->dateTimeBetween('-3 days', '+3 days'))
                    : null,
                'user_id'             => $userId,
                'created_by_id'       => 1,
                'created_at'          => now()->subDays(rand(0, 60)),
                'updated_at'          => now(),
            ];
        }

        DB::table('leads')->insert($rows);
    }
}
