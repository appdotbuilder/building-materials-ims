<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of warehouses.
     */
    public function index()
    {
        $warehouses = Warehouse::latest()->paginate(10);

        return Inertia::render('warehouses/index', [
            'warehouses' => $warehouses,
        ]);
    }

    /**
     * Show the form for creating a new warehouse.
     */
    public function create()
    {
        return Inertia::render('warehouses/create');
    }

    /**
     * Store a newly created warehouse.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:warehouses,code',
            'address' => 'nullable|string',
            'manager' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $warehouse = Warehouse::create($validated);

        return redirect()->route('warehouses.show', $warehouse)
            ->with('success', 'Warehouse created successfully.');
    }

    /**
     * Display the specified warehouse.
     */
    public function show(Warehouse $warehouse)
    {
        $warehouse->load(['inventory.product.category']);

        return Inertia::render('warehouses/show', [
            'warehouse' => $warehouse,
        ]);
    }

    /**
     * Show the form for editing the specified warehouse.
     */
    public function edit(Warehouse $warehouse)
    {
        return Inertia::render('warehouses/edit', [
            'warehouse' => $warehouse,
        ]);
    }

    /**
     * Update the specified warehouse.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:warehouses,code,' . $warehouse->id,
            'address' => 'nullable|string',
            'manager' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $warehouse->update($validated);

        return redirect()->route('warehouses.show', $warehouse)
            ->with('success', 'Warehouse updated successfully.');
    }

    /**
     * Remove the specified warehouse.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->update(['is_active' => false]);

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse deactivated successfully.');
    }
}