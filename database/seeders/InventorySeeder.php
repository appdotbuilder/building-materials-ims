<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories first
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

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['code' => $categoryData['code']],
                $categoryData + ['is_active' => true]
            );
        }

        // Create warehouses
        $warehouses = [
            ['name' => 'Main Warehouse', 'code' => 'MAIN', 'manager' => 'John Smith', 'phone' => '+1-555-0101'],
            ['name' => 'North Branch', 'code' => 'NORTH', 'manager' => 'Sarah Johnson', 'phone' => '+1-555-0102'],
            ['name' => 'South Branch', 'code' => 'SOUTH', 'manager' => 'Mike Wilson', 'phone' => '+1-555-0103'],
            ['name' => 'Downtown Storage', 'code' => 'DOWN', 'manager' => 'Lisa Brown', 'phone' => '+1-555-0104'],
        ];

        foreach ($warehouses as $warehouseData) {
            Warehouse::firstOrCreate(
                ['code' => $warehouseData['code']],
                $warehouseData + [
                    'address' => fake()->address(),
                    'is_active' => true
                ]
            );
        }

        // Create suppliers
        $suppliers = [
            'MegaConcrete Solutions Ltd',
            'BuildRight Materials Co.',
            'Steel Masters Supply',
            'Premier Aggregates Inc.',
            'City Hardware & Tools',
            'RoofTech Materials',
            'PlumbPro Supplies',
            'ElectroMax Distributors',
        ];

        foreach ($suppliers as $supplierName) {
            Supplier::firstOrCreate(
                ['name' => $supplierName],
                [
                    'contact_person' => fake()->name(),
                    'email' => fake()->companyEmail(),
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->address(),
                    'tax_id' => 'TIN-' . fake()->numerify('#########'),
                    'status' => 'active',
                ]
            );
        }

        // Create products for each category
        $categoryProducts = [
            'CEM' => [
                ['name' => 'Portland Cement Type I', 'sku' => 'CEM-001', 'unit' => 'bag', 'cost' => 15.50, 'price' => 18.00],
                ['name' => 'Portland Cement Type II', 'sku' => 'CEM-002', 'unit' => 'bag', 'cost' => 16.00, 'price' => 19.00],
                ['name' => 'Ready-Mix Concrete C25', 'sku' => 'CEM-003', 'unit' => 'm³', 'cost' => 85.00, 'price' => 105.00],
                ['name' => 'Concrete Additive - Plasticizer', 'sku' => 'CEM-004', 'unit' => 'L', 'cost' => 8.25, 'price' => 12.00],
            ],
            'STL' => [
                ['name' => '10mm Deformed Bar', 'sku' => 'STL-001', 'unit' => 'pcs', 'cost' => 35.00, 'price' => 45.00],
                ['name' => '12mm Deformed Bar', 'sku' => 'STL-002', 'unit' => 'pcs', 'cost' => 45.00, 'price' => 55.00],
                ['name' => '16mm Deformed Bar', 'sku' => 'STL-003', 'unit' => 'pcs', 'cost' => 75.00, 'price' => 90.00],
                ['name' => 'Galvanized Steel Sheet 24G', 'sku' => 'STL-004', 'unit' => 'pcs', 'cost' => 285.00, 'price' => 350.00],
            ],
            'AGG' => [
                ['name' => 'Fine Sand', 'sku' => 'AGG-001', 'unit' => 'm³', 'cost' => 25.00, 'price' => 35.00],
                ['name' => 'Coarse Gravel 3/4"', 'sku' => 'AGG-002', 'unit' => 'm³', 'cost' => 30.00, 'price' => 42.00],
                ['name' => 'Crushed Stone 1/2"', 'sku' => 'AGG-003', 'unit' => 'm³', 'cost' => 28.00, 'price' => 38.00],
            ],
            'BLK' => [
                ['name' => 'Concrete Hollow Block 4"', 'sku' => 'BLK-001', 'unit' => 'pcs', 'cost' => 12.50, 'price' => 16.00],
                ['name' => 'Concrete Hollow Block 6"', 'sku' => 'BLK-002', 'unit' => 'pcs', 'cost' => 18.00, 'price' => 23.00],
                ['name' => 'Red Clay Brick', 'sku' => 'BLK-003', 'unit' => 'pcs', 'cost' => 8.75, 'price' => 12.00],
            ],
        ];

        foreach ($categoryProducts as $categoryCode => $products) {
            $category = Category::where('code', $categoryCode)->first();
            
            foreach ($products as $productData) {
                Product::firstOrCreate(
                    ['sku' => $productData['sku']],
                    [
                        'name' => $productData['name'],
                        'category_id' => $category->id,
                        'primary_unit' => $productData['unit'],
                        'unit_cost' => $productData['cost'],
                        'selling_price' => $productData['price'],
                        'min_stock_level' => random_int(10, 50),
                        'max_stock_level' => random_int(100, 500),
                        'reorder_level' => random_int(20, 80),
                        'is_active' => true,
                        'barcode' => fake()->optional(0.7)->ean13(),
                        'description' => fake()->sentence(),
                    ]
                );
            }
        }

        // Create initial inventory and stock movements
        $products = Product::all();
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        $user = User::first();

        foreach ($products as $product) {
            foreach ($warehouses->take(random_int(1, 3)) as $warehouse) {
                $initialStock = random_int(50, 200);
                
                // Create inventory record
                $inventory = Inventory::firstOrCreate([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                ], [
                    'quantity' => $initialStock,
                    'location' => fake()->optional(0.8)->bothify('??-##-??'),
                    'reserved_quantity' => 0,
                    'available_quantity' => $initialStock,
                ]);

                // Create initial stock in movement
                StockMovement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'type' => 'in',
                    'quantity' => $initialStock,
                    'unit_cost' => $product->unit_cost,
                    'reference_number' => 'INIT-' . fake()->numerify('####'),
                    'notes' => 'Initial stock',
                    'supplier_id' => $suppliers->random()->id,
                    'user_id' => $user->id,
                    'created_at' => now()->subDays(random_int(1, 30)),
                ]);

                // Create some random movements
                for ($i = 0; $i < random_int(2, 8); $i++) {
                    $type = fake()->randomElement(['in', 'out', 'adjustment']);
                    $quantity = random_int(1, 20);
                    
                    if ($type === 'out' && $inventory->quantity >= $quantity) {
                        $inventory->decrement('quantity', $quantity);
                        $quantity = -$quantity; // Negative for out movements
                    } elseif ($type === 'in') {
                        $inventory->increment('quantity', $quantity);
                    }

                    StockMovement::create([
                        'product_id' => $product->id,
                        'warehouse_id' => $warehouse->id,
                        'type' => $type,
                        'quantity' => $quantity,
                        'unit_cost' => $type === 'in' ? $product->unit_cost * fake()->randomFloat(2, 0.8, 1.2) : null,
                        'reference_number' => fake()->optional(0.6)->bothify('REF-####'),
                        'notes' => fake()->optional(0.4)->sentence(),
                        'supplier_id' => $type === 'in' ? $suppliers->random()->id : null,
                        'user_id' => $user->id,
                        'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                    ]);
                }

                $inventory->update([
                    'available_quantity' => $inventory->quantity - $inventory->reserved_quantity
                ]);
            }
        }
    }
}