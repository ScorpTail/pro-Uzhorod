<?php

namespace Database\Factories\News;

use App\Enums\StatusEnum;
use App\Models\News\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        News::truncate();

        return [
            'title'             => $this->faker->text(255),
            'content'           => $this->faker->text,
            'short_description' => $this->faker->text(155),
            'status'            => StatusEnum::ACTIVE->value,
            'views'             => $this->faker->numberBetween(0, 1000),
            'user_id'           => 1,
        ];
    }
}
