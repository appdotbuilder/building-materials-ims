<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display the main inventory dashboard.
     */
    public function index()
    {
        $lowStockProducts = Product::with(['category', 'inventory.warehouse'])
            ->whereRaw('(SELECT COALESCE(SUM(quantity), 0) FROM inventory WHERE product_id = products.id) <= min_stock_level')
            ->take(5)
            ->get();

        $recentMovements = StockMovement::with(['product', 'warehouse', 'supplier', 'user'])
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total_products' => Product::active()->count(),
            'total_categories' => Category::active()->count(),
            'total_warehouses' => Warehouse::active()->count(),
            'low_stock_items' => Product::whereRaw('(SELECT COALESCE(SUM(quantity), 0) FROM inventory WHERE product_id = products.id) <= min_stock_level')->count(),
        ];

        return Inertia::render('inventory/dashboard', [
            'lowStockProducts' => $lowStockProducts,
            'recentMovements' => $recentMovements,
            'stats' => $stats,
        ]);
    }

    /**
     * Show the stock levels view.
     */
    public function show()
    {
        $products = Product::with(['category', 'inventory.warehouse'])
            ->active()
            ->paginate(20);

        return Inertia::render('inventory/stock', [
            'products' => $products,
        ]);
    }

    /**
     * Store a new stock movement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type' => 'required|in:in,out,transfer,adjustment',
            'quantity' => 'required|numeric',
            'unit_cost' => 'nullable|numeric|min:0',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'transfer_to_warehouse_id' => 'nullable|exists:warehouses,id',
        ]);

        $validated['user_id'] = auth()->id();

        // Create stock movement record
        $movement = StockMovement::create($validated);

        // Update inventory
        $inventory = Inventory::firstOrCreate([
            'product_id' => $validated['product_id'],
            'warehouse_id' => $validated['warehouse_id'],
        ]);

        if ($validated['type'] === 'in' || $validated['type'] === 'adjustment') {
            $inventory->increment('quantity', abs($validated['quantity']));
        } elseif ($validated['type'] === 'out') {
            $inventory->decrement('quantity', abs($validated['quantity']));
        } elseif ($validated['type'] === 'transfer' && $validated['transfer_to_warehouse_id']) {
            // Decrease from source warehouse
            $inventory->decrement('quantity', abs($validated['quantity']));
            
            // Increase in destination warehouse
            $destinationInventory = Inventory::firstOrCreate([
                'product_id' => $validated['product_id'],
                'warehouse_id' => $validated['transfer_to_warehouse_id'],
            ]);
            $destinationInventory->increment('quantity', abs($validated['quantity']));
        }

        return redirect()->back()->with('success', 'Stock movement recorded successfully.');
    }
}