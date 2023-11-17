<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = public_path('images');
        $images = File::files($imagePath);
        $imageNames = array_map('basename', $images);

        return [
            'name' => $this->faker->name,
            'age' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Change it based on your needs
            'role' => $this->faker->randomElement(['admin', 'manager', 'hr', 'finance', 'employee', 'dataentry']),
            'mobile' => $this->faker->unique()->numerify('###########'),
            'address' => $this->faker->address,
            'jobTitle' => $this->faker->jobTitle,
            'salary' => $this->faker->randomNumber(5),
            'department' => $this->faker->randomElement(['programming', 'graphics', 'Marketing', 'Administrative', 'photography', 'video', 'sales']),
            'status' => $this->faker->randomElement(['permanent', 'temporary', 'trainee']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'image' => $this->faker->randomElement($imageNames),
            // 'image' => $this->faker->randomElement($images),
            'image2' =>  '1Egyption_ID.jpg',
            'image3' => 'Egyption_ID.jpg',
            'creator_name' => $this->faker->name,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
