<?php

namespace Database\Factories;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();

        return [
            'day' => Carbon::now()->month(rand(1, 12))->day(rand(1, Carbon::now()->daysInMonth))->format('Y-m-d'),
            'absent' => $this->faker->boolean,
            'on_leave' => function (array $attributes) {
                // Only set 'on_leave' if 'absent' is false
                return !$attributes['absent'] ? $this->faker->boolean : false;
            },
            'check_in' => function (array $attributes) {
                // Set 'check_in' only if 'on_leave' is false and 'absent' is false
                return !$attributes['on_leave'] && !$attributes['absent'] ? $this->faker->time : null;
            },
            'check_out' => function (array $attributes) {
                // Set 'check_out' only if 'check_in' is set
                return $attributes['check_in'] ? $this->faker->time : null;
            },
            'notes' => $this->faker->text,
            'rating' => $this->faker->numberBetween(1, 10),
            'entry_date' => Carbon::now()->format('Y-m-d'),
            'employee_id' => $user->id,
            'creator_name' => $this->faker->name,
        ];
    }

}
