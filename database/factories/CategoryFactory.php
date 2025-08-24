<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Cement & Concrete', 'code' => 'CEM', 'description' => 'Portland cement, ready-mix concrete, additives'],
            ['name' => 'Steel & Rebar', 'code' => 'STL', 'description' => 'Reinforcement bars, steel sheets, structural steel'],
            ['name' => 'Aggregates', 'code' => 'AGG', 'description' => 'Sand, gravel, crushed stone, ballast'],
            ['name' => 'Blocks & Bricks', 'code' => 'BLK', 'description' => 'Concrete blocks, clay bricks, pavers'],
            ['name' => 'Roofing Materials', 'code' => 'ROF', 'description' => 'Metal sheets, tiles, insulation, gutters'],
            ['name' => 'Plumbing Supplies', 'code' => 'PLM', 'description' => 'Pipes, fittings, valves, fixtures'],
            ['name' => 'Electrical Supplies', 'code' => 'ELC', 'description' => 'Cables, conduits, switches, outlets'],
            ['name' => 'Hardware & Tools', 'code' => 'HRD', 'description' => 'Nails, screws, bolts, hand tools'],
        ];

        $category = fake()->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'code' => $category['code'],
            'description' => $category['description'],
            'is_active' => true,
        ];
    }
}