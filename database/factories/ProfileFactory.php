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
            'grade_id' => fake()->numberBetween(0, 12),
            'subject_id' => fake()->numberBetween(0, 30),
            'school_id' => $school_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'teacher_id' => fake()->unique()->numberBetween(1, $teachers->count())
        ];
    }
}
