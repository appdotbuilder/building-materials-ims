<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $suppliers = [
            'MegaConcrete Solutions Ltd',
            'BuildRight Materials Co.',
            'Steel Masters Supply',
            'Premier Aggregates Inc.',
            'City Hardware & Tools',
            'RoofTech Materials',
            'PlumbPro Supplies',
            'ElectroMax Distributors',
            'Construction Zone Ltd',
            'Industrial Building Supply',
        ];

        return [
            'name' => fake()->randomElement($suppliers),
            'contact_person' => fake()->name(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'tax_id' => fake()->numerify('TIN-#########'),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']), // Mostly active
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}