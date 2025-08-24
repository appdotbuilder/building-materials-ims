<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $warehouses = [
            ['name' => 'Main Warehouse', 'code' => 'MAIN'],
            ['name' => 'North Branch', 'code' => 'NORTH'],
            ['name' => 'South Branch', 'code' => 'SOUTH'],
            ['name' => 'Downtown Storage', 'code' => 'DOWN'],
            ['name' => 'Industrial Zone', 'code' => 'INDZ'],
        ];

        $warehouse = fake()->randomElement($warehouses);

        return [
            'name' => $warehouse['name'],
            'code' => $warehouse['code'],
            'address' => fake()->address(),
            'manager' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'is_active' => true,
        ];
    }
}