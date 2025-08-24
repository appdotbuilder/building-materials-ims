<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            // Cement & Concrete
            ['name' => 'Portland Cement Type I', 'unit' => 'bag', 'cost' => 15.50, 'price' => 18.00],
            ['name' => 'Ready-Mix Concrete C25', 'unit' => 'm³', 'cost' => 85.00, 'price' => 105.00],
            ['name' => 'Concrete Additive - Plasticizer', 'unit' => 'L', 'cost' => 8.25, 'price' => 12.00],
            
            // Steel & Rebar
            ['name' => '12mm Deformed Bar', 'unit' => 'pcs', 'cost' => 45.00, 'price' => 55.00],
            ['name' => '16mm Deformed Bar', 'unit' => 'pcs', 'cost' => 75.00, 'price' => 90.00],
            ['name' => 'Galvanized Steel Sheet 24G', 'unit' => 'pcs', 'cost' => 285.00, 'price' => 350.00],
            
            // Aggregates
            ['name' => 'Fine Sand', 'unit' => 'm³', 'cost' => 25.00, 'price' => 35.00],
            ['name' => 'Coarse Gravel 3/4"', 'unit' => 'm³', 'cost' => 30.00, 'price' => 42.00],
            ['name' => 'Crushed Stone 1/2"', 'unit' => 'm³', 'cost' => 28.00, 'price' => 38.00],
            
            // Blocks & Bricks
            ['name' => 'Concrete Hollow Block 4"', 'unit' => 'pcs', 'cost' => 12.50, 'price' => 16.00],
            ['name' => 'Concrete Hollow Block 6"', 'unit' => 'pcs', 'cost' => 18.00, 'price' => 23.00],
            ['name' => 'Red Clay Brick', 'unit' => 'pcs', 'cost' => 8.75, 'price' => 12.00],
        ];

        $product = fake()->randomElement($products);
        $unitCost = $product['cost'];
        $sellingPrice = $product['price'];

        return [
            'name' => $product['name'],
            'sku' => strtoupper(fake()->bothify('???-####')),
            'barcode' => fake()->optional(0.7)->ean13(),
            'description' => fake()->sentence(),
            'category_id' => Category::factory(),
            'primary_unit' => $product['unit'],
            'unit_cost' => $unitCost,
            'selling_price' => $sellingPrice,
            'min_stock_level' => random_int(10, 50),
            'max_stock_level' => random_int(100, 500),
            'reorder_level' => random_int(20, 80),
            'is_active' => true,
        ];
    }
}