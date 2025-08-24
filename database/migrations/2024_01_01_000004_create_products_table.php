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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique()->comment('Stock Keeping Unit');
            $table->string('barcode')->nullable()->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('primary_unit')->comment('Primary unit of measure (e.g., kg, pcs, m)');
            $table->decimal('unit_cost', 10, 2)->default(0)->comment('Cost per unit');
            $table->decimal('selling_price', 10, 2)->default(0)->comment('Selling price per unit');
            $table->integer('min_stock_level')->default(0)->comment('Minimum stock level for alerts');
            $table->integer('max_stock_level')->default(0)->comment('Maximum stock level');
            $table->integer('reorder_level')->default(0)->comment('Reorder point');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('name');
            $table->index('sku');
            $table->index('category_id');
            $table->index('is_active');
            $table->index(['category_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};