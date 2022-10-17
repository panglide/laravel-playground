<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;
use App\Models\Teacher;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $school_id = School::where('nces_school_id', 470318001254)->select('id')->first();
        $teachers = Teacher::all();

        return [
            'grade_id' => fake()->numberBetween(0, 5),
            'subject_id' => fake()->numberBetween(1, 6),
            'school_id' => $school_id,
            'coach_id' => fake()->unique()->numberBetween(1, 4),
            'avatar_url' => fake()->image(public_path('images'), 300, 300, null, false),
            'pd_notes' => fake()->sentences('3', true),
            'last_touch' => fake()->dateTimeBetween(Carbon::now()->subMonths('4'), Carbon::now()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'teacher_id' => fake()->unique()->numberBetween(1, $teachers->count())
        ];
    }
}
