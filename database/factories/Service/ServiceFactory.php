<?php

namespace Database\Factories\Service;

use App\Enums\StatusEnum;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Service::truncate();

        return [
            'name'               => $this->faker->company(),
            'description'        => $this->faker->text,
            'short_description'  => $this->faker->text(155),
            'status'             => StatusEnum::ACTIVE->value,
            'working_days'       => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
            'start_work'         => $this->faker->time(),
            'end_work'           => $this->faker->time(),
            'weekend_start_work' => $this->faker->time(),
            'weekend_end_work'   => $this->faker->time(),
            'location'           => $this->faker->address(),
            'phone'              => $this->faker->phoneNumber(),
        ];
    }
}
