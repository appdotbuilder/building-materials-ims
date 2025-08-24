<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->enum('type', ['in', 'out', 'transfer', 'adjustment'])->comment('Type of stock movement');
            $table->decimal('quantity', 15, 3)->comment('Quantity moved (positive for in, negative for out)');
            $table->decimal('unit_cost', 10, 2)->nullable()->comment('Cost per unit for this movement');
            $table->string('reference_number')->nullable()->comment('PO number, invoice number, etc.');
            $table->text('notes')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('transfer_to_warehouse_id')->nullable()->constrained('warehouses');
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('warehouse_id');
            $table->index('type');
            $table->index('created_at');
            $table->index(['product_id', 'type']);
            $table->index(['product_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};