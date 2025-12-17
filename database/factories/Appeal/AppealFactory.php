<?php

namespace Database\Factories\Appeal;

use App\Enums\StatusEnum;
use App\Models\Appeal\Appeal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appeal\Appeal>
 */
class AppealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Appeal::truncate();

        return [
            'title'            => $this->faker->sentence(),
            'content'          => $this->faker->text(),
            'status'           => StatusEnum::ACTIVE->value,
            // 'user_id'          => $this->faker->phoneNumber(),
            'administrator_id' => 1,
        ];
    }
}
