<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = random_int(0, 200);
        $reserved = random_int(0, (int)($quantity * 0.3));
        $available = $quantity - $reserved;

        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'quantity' => $quantity,
            'location' => fake()->optional(0.8)->bothify('??-##-??'),
            'reserved_quantity' => $reserved,
            'available_quantity' => $available,
        ];
    }
}