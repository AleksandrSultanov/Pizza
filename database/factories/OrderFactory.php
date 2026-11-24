<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'total_price' => fake()->randomFloat(2, 200, 5000),
            'order_date' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
