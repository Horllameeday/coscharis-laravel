<?php

namespace Database\Factories;

use App\Models\ClientPriceMatrix;
use App\Models\PickupType;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hours = $this->faker->numberBetween(0, 12);
        $minutes = $this->faker->numberBetween(1, 59);

        $duration = $hours > 0
        ? "$hours hours $minutes mins"
        : "$minutes mins";

        return [
            'id' => Str::uuid(),
            'user_id' => User::inRandomOrder()->first()->id,
            'pickup_type_id' => PickupType::inRandomOrder()->first()->id,
            'sender_person' => fake()->name(),
            'sender_number' => '+234' . fake()->randomElement(['80', '81', '90', '91', '70', '71']) . fake()->numerify('########'),
            'pickup_place_id' => fake()->regexify('ChI[a-zA-Z0-9_-]{24}'),
            'pickup_place_name' => fake()->streetName(),
            'pickup_place_longitude' => fake()->longitude(),
            'pickup_place_latitude' => fake()->latitude(),
            'receiver_person' => fake()->name(),
            'receiver_number' => '+234' . fake()->randomElement(['80', '81', '90', '91', '70', '71']) . fake()->numerify('########'),
            'destination_place_id' => fake()->regexify('ChI[a-zA-Z0-9_-]{24}'),
            'destination_place_name' => fake()->streetName(),
            'destination_place_longitude' => fake()->longitude(),
            'destination_place_latitude' => fake()->latitude(),
            'preferred_pickup_date' => now(),
            'preferred_delivery_date' => now(),
            'distance' => fake()->numberBetween(10, 100000),
            'duration' => $duration,
            'client_price_matrix_id' => ClientPriceMatrix::where('default', true)->first(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Shipment $shipment) {
            ShipmentItem::factory()
                ->count(rand(1, 5))
                ->create([
                    'shipment_id' => $shipment->id,
                ]);
        });
    }
}
