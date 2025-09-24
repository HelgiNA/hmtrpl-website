<?php
namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_number'  => 'G1A0' . fake()->unique()->numberBetween(20, 23) . '0' . fake()->unique()->numberBetween(10, 99),
            'full_name'       => fake()->name(),
            'enrollment_year' => fake()->numberBetween(2000, 2023),
            'email'           => fake()->unique()->safeEmail(),
            'phone_number'    => fake()->phoneNumber(),
            'status'          => 'active',
            'join_date'       => fake()->dateTimeBetween('-3 years', 'Now'),
            'division_id'     => Division::factory(),
        ];
    }
}
