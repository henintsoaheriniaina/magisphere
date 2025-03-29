<?php

namespace Database\Factories;

use App\Models\Post;
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
        $desc = $this->faker->sentence(2);
        $slug = Str::slug(substr($desc, 0, 50));
        $count = Post::where('slug', 'like', "$slug%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;
        return [
            'description' => $desc,
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => 'approved',
            'slug' => $slug,
        ];
    }
}
