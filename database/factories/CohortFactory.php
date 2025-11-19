<?php

namespace Database\Factories;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CohortFactory extends Factory
{
    protected $model = Cohort::class;

    public function definition()
    {
        $trainer = User::role('Trainer')->inRandomOrder()->first();
        //$corporateClient = User::role('Corporate_Client')->inRandomOrder()->first();
        return [
            'max_learner' => $this->faker->numberBetween(1, 10),
            'course_id' => $this->faker->numberBetween(1, 16),
            'venue_id' => $this->faker->numberBetween(1, 5),
            'trainer_id' => $trainer->id, //$this->faker->numberBetween(8, 11),
            'delivery_mode' => 'ClassroomBased',
            'corporate_client_id' => null,
            'start_date_time' => $this->faker->dateTimeBetween('2025-03-12 09:00:00', '2025-04-23 09:00:00'),
            'end_date_time' => $this->faker->dateTimeBetween('2025-09-12 17:30:00', '2025-10-23 17:30:00'),
            'booking_reference' => $this->faker->unique()->word,
            'lesson_plan' => null,
            'invoice' => null,
            'status' => 'Confirmed',
            'user_id' => 1, // You may adjust this based on your logic
        ];
    }
}
