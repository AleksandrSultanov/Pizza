<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        Order::factory(10)->create()->each(function (Order $order) use ($products) {
            foreach ($products->random(fake()->numberBetween(1, 3)) as $product) {
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => fake()->numberBetween(1, 3),
                    'unit_price' => $product->price,
                ]);
            }
            $order->update([
                'total_price' => $order->items->sum(
                    fn ($item) => $item->quantity * $item->unit_price
                ),
            ]);
        });
    }
}
