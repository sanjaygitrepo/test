<?php

namespace Database\Factories;

use App\Models\{
    User,
    Post
};
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::get()->random()->id,
            'post_id' => Post::get()->random()->id,
            'comment_body' => $this->faker->paragraph(2),
        ];
    }
}
