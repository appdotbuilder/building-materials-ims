<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['in', 'out', 'adjustment']);
        $quantity = random_int(1, 50);
        
        // Make quantity negative for 'out' movements
        if ($type === 'out') {
            $quantity = -$quantity;
        }

        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'type' => $type,
            'quantity' => $quantity,
            'unit_cost' => fake()->optional(0.8)->randomFloat(2, 5, 100),
            'reference_number' => fake()->optional(0.6)->bothify('REF-####'),
            'notes' => fake()->optional(0.4)->sentence(),
            'supplier_id' => $type === 'in' ? Supplier::factory() : null,
            'user_id' => User::factory(),
            'transfer_to_warehouse_id' => null,
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}