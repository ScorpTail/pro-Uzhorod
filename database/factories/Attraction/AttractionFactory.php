<?php

namespace Database\Factories\Attraction;

use App\Enums\StatusEnum;
use App\Models\Attraction\Attraction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attraction\Attraction>
 */
class AttractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Attraction::truncate();

        return [
            'name'            => $this->faker->company(),
            'description'     => $this->faker->text,
            'short_description' => $this->faker->text(155),
            'status'          => StatusEnum::ACTIVE->value,
            'location'        => $this->faker->address(),
            'entry_fee'       => $this->faker->randomFloat(2, 0, 100),
            'working_days'     => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
            'start_time'      => $this->faker->time(),
            'end_time'        => $this->faker->time(),
            'weekend_start_time' => $this->faker->time(),
            'weekend_end_time'   => $this->faker->time(),
            'rating'          => $this->faker->randomFloat(2, 0, 5),
        ];
    }
}
