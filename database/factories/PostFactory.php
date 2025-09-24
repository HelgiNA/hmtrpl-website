<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title'        => $title,
            'slug'         => Str::slug($title),
            'content'      => fake()->paragraphs(5, true),
            'excerpt'      => fake()->paragraph(2),
            'status'       => fake()->randomElement(['published', 'draft']),
            'published_at' => now(),
            'author_id'    => User::factory(),
            'category_id'  => Category::factory(),
        ];
    }
}
