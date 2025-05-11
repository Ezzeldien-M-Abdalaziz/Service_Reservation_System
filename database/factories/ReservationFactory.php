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
    $reservationDate = $this->faker->dateTimeBetween('-1 month', '+1 week');

    $startHour = 8;
    $endHour = 19;
    $hour = $this->faker->numberBetween($startHour, $endHour - 1);
    $minute = $this->faker->randomElement([0, 30]);

    // Combine date and time
    $from = (clone $reservationDate)->setTime($hour, $minute);
    $duration = $this->faker->randomElement([30, 60]);
    $to = (clone $from)->modify("+{$duration} minutes");

    $service = Service::inRandomOrder()->first() ?? Service::factory()->create();
    $service_price_in_min = $service->price / 60;

    $status = $to < now()
        ? $this->faker->randomElement(['confirmed', 'cancelled'])
        : $this->faker->randomElement(['confirmed', 'pending']);

    $paid_price = $status === 'confirmed' ? $service_price_in_min * $duration : null;

    return [
        'user_id' => 1,
        'service_id' => $service->id,
        'date' => $reservationDate->format('Y-m-d'),
        'from' => $from->format('H:i:s'), // assuming TIME column
        'to' => $to->format('H:i:s'),
        'status' => $status,
        'paid_price' => $paid_price,
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

}
