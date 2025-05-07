<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $from = $this->faker->dateTimeBetween('-1 week', '+2 weeks');
        $duration = $this->faker->randomElement([30, 60, 90, 120]);
        $to = (clone $from)->modify("+{$duration} minutes");

        $service = Service::inRandomOrder()->first() ?? Service::factory()->create();
        $service_price_in_min = $service->price / 60;

        $status = $to < now()
            ? $this->faker->randomElement(['confirmed', 'cancelled'])
            : $this->faker->randomElement(['confirmed', 'pending']);

        $paid_price = $status === 'confirmed' ? $service_price_in_min * $duration : null;

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'service_id' => $service->id,
            'from' => $from,
            'to' => $to,
            'status' => $status,
            'paid_price' => $paid_price,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
