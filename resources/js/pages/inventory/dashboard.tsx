import React from 'react';
import { AppShell } from '@/components/app-shell';

import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Link } from '@inertiajs/react';

interface Product {
    id: number;
    name: string;
    sku: string;
    total_stock: number;
    min_stock_level: number;
    category: {
        name: string;
        code: string;
    };
    inventory: Array<{
        quantity: number;
        warehouse: {
            name: string;
            code: string;
        };
    }>;
}

interface StockMovement {
    id: number;
    type: string;
    quantity: number;
    created_at: string;
    product: {
        name: string;
        sku: string;
    };
    warehouse: {
        name: string;
        code: string;
    };
    supplier?: {
        name: string;
    };
    user: {
        name: string;
    };
}

interface Stats {
    total_products: number;
    total_categories: number;
    total_warehouses: number;
    low_stock_items: number;
}

interface Props {
    lowStockProducts: Product[];
    recentMovements: StockMovement[];
    stats: Stats;
    [key: string]: unknown;
}

export default function InventoryDashboard({ lowStockProducts, recentMovements, stats }: Props) {
    const getMovementTypeColor = (type: string) => {
        switch (type) {
            case 'in': return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'out': return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
            case 'transfer': return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
            case 'adjustment': return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
            default: return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
        }
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    return (
        <AppShell>
            <div className="space-y-6">
                {/* Header */}
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 className="text-3xl font-bold flex items-center gap-2 mb-2">
                            📦 Inventory Management System
                        </h1>
                        <p className="text-muted-foreground">
                            Building Materials Store - Comprehensive Stock & Warehouse Management
                        </p>
                    </div>
                    <div className="flex gap-2 flex-wrap">
                        <Button asChild size="sm">
                            <Link href="/products/create">Add Product</Link>
                        </Button>
                        <Button asChild variant="outline" size="sm">
                            <Link href="/inventory">View Stock</Link>
                        </Button>
                    </div>
                </div>

                {/* Key Stats */}
                <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <Card>
                        <CardHeader className="pb-2">
                            <CardTitle className="text-2xl font-bold text-blue-600">
                                {stats.total_products}
                            </CardTitle>
                            <CardDescription className="flex items-center gap-1">
                                📋 Total Products
                            </CardDescription>
                        </CardHeader>
                    </Card>
                    
                    <Card>
                        <CardHeader className="pb-2">
                            <CardTitle className="text-2xl font-bold text-green-600">
                                {stats.total_categories}
                            </CardTitle>
                            <CardDescription className="flex items-center gap-1">
                                🏷️ Categories
                            </CardDescription>
                        </CardHeader>
                    </Card>
                    
                    <Card>
                        <CardHeader className="pb-2">
                            <CardTitle className="text-2xl font-bold text-purple-600">
                                {stats.total_warehouses}
                            </CardTitle>
                            <CardDescription className="flex items-center gap-1">
                                🏬 Warehouses
                            </CardDescription>
                        </CardHeader>
                    </Card>
                    
                    <Card className={stats.low_stock_items > 0 ? "border-red-200 bg-red-50 dark:bg-red-950/20" : ""}>
                        <CardHeader className="pb-2">
                            <CardTitle className={`text-2xl font-bold ${stats.low_stock_items > 0 ? 'text-red-600' : 'text-orange-600'}`}>
                                {stats.low_stock_items}
                            </CardTitle>
                            <CardDescription className="flex items-center gap-1">
                                ⚠️ Low Stock Alert
                            </CardDescription>
                        </CardHeader>
                    </Card>
                </div>

                <div className="grid lg:grid-cols-2 gap-6">
                    {/* Low Stock Products */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                ⚠️ Low Stock Alert
                                <Badge variant="destructive" className="ml-auto">
                                    {lowStockProducts.length} items
                                </Badge>
                            </CardTitle>
                            <CardDescription>
                                Products below minimum stock levels require immediate attention
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            {lowStockProducts.length > 0 ? (
                                <div className="space-y-3">
                                    {lowStockProducts.map((product) => (
                                        <div key={product.id} className="flex items-center justify-between p-3 border border-red-200 bg-red-50 dark:bg-red-950/20 rounded-lg">
                                            <div className="space-y-1">
                                                <p className="font-medium text-sm">{product.name}</p>
                                                <p className="text-xs text-muted-foreground">
                                                    SKU: {product.sku} • {product.category.name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-medium text-red-600">
                                                    {product.total_stock} / {product.min_stock_level}
                                                </p>
                                                <p className="text-xs text-muted-foreground">
                                                    Current / Min
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                    <Button asChild variant="outline" size="sm" className="w-full">
                                        <Link href="/inventory">View All Stock Levels</Link>
                                    </Button>
                                </div>
                            ) : (
                                <div className="text-center py-6 text-muted-foreground">
                                    <p className="text-2xl mb-2">✅</p>
                                    <p>All products are adequately stocked!</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    {/* Recent Stock Movements */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                📊 Recent Stock Movements
                            </CardTitle>
                            <CardDescription>
                                Latest inventory transactions and updates
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            {recentMovements.length > 0 ? (
                                <div className="space-y-3">
                                    {recentMovements.slice(0, 8).map((movement) => (
                                        <div key={movement.id} className="flex items-center justify-between p-2 border rounded">
                                            <div className="space-y-1">
                                                <div className="flex items-center gap-2">
                                                    <Badge variant="secondary" className={getMovementTypeColor(movement.type)}>
                                                        {movement.type.toUpperCase()}
                                                    </Badge>
                                                    <span className="text-sm font-medium">
                                                        {Math.abs(movement.quantity)}
                                                    </span>
                                                </div>
                                                <p className="text-xs text-muted-foreground">
                                                    {movement.product.name} • {movement.warehouse.name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-xs text-muted-foreground">
                                                    {formatDate(movement.created_at)}
                                                </p>
                                                <p className="text-xs text-muted-foreground">
                                                    by {movement.user.name}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                    <Button asChild variant="outline" size="sm" className="w-full">
                                        <Link href="/inventory">View All Movements</Link>
                                    </Button>
                                </div>
                            ) : (
                                <div className="text-center py-6 text-muted-foreground">
                                    <p className="text-2xl mb-2">📊</p>
                                    <p>No recent stock movements</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>

                {/* Quick Actions */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center gap-2">
                            ⚡ Quick Actions
                        </CardTitle>
                        <CardDescription>
                            Frequently used inventory management tasks
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <Button asChild variant="outline" className="h-20 flex flex-col gap-2">
                                <Link href="/products">
                                    <span className="text-2xl">📦</span>
                                    <span className="text-sm">Manage Products</span>
                                </Link>
                            </Button>
                            <Button asChild variant="outline" className="h-20 flex flex-col gap-2">
                                <Link href="/warehouses">
                                    <span className="text-2xl">🏬</span>
                                    <span className="text-sm">Warehouses</span>
                                </Link>
                            </Button>
                            <Button asChild variant="outline" className="h-20 flex flex-col gap-2">
                                <Link href="/inventory">
                                    <span className="text-2xl">📊</span>
                                    <span className="text-sm">Stock Levels</span>
                                </Link>
                            </Button>
                            <Button asChild variant="outline" className="h-20 flex flex-col gap-2">
                                <Link href="/products/create">
                                    <span className="text-2xl">➕</span>
                                    <span className="text-sm">Add Product</span>
                                </Link>
                            </Button>
                        </div>
                    </CardContent>
                </Card>

                {/* Feature Highlights */}
                <Card className="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/20 dark:to-indigo-950/20">
                    <CardHeader>
                        <CardTitle className="flex items-center gap-2">
                            🌟 System Features
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                            <div className="flex items-start gap-2">
                                <span className="text-lg">📦</span>
                                <div>
                                    <strong>Stock Management</strong>
                                    <p className="text-muted-foreground">Track in/out movements with full history</p>
                                </div>
                            </div>
                            <div className="flex items-start gap-2">
                                <span className="text-lg">🏬</span>
                                <div>
                                    <strong>Multi-Warehouse</strong>
                                    <p className="text-muted-foreground">Manage inventory across multiple locations</p>
                                </div>
                            </div>
                            <div className="flex items-start gap-2">
                                <span className="text-lg">⚠️</span>
                                <div>
                                    <strong>Low Stock Alerts</strong>
                                    <p className="text-muted-foreground">Automatic notifications for reordering</p>
                                </div>
                            </div>
                            <div className="flex items-start gap-2">
                                <span className="text-lg">🏷️</span>
                                <div>
                                    <strong>Category System</strong>
                                    <p className="text-muted-foreground">Organized product categorization</p>
                                </div>
                            </div>
                            <div className="flex items-start gap-2">
                                <span className="text-lg">🤝</span>
                                <div>
                                    <strong>Supplier Management</strong>
                                    <p className="text-muted-foreground">Track suppliers and purchase history</p>
                                </div>
                            </div>
                            <div className="flex items-start gap-2">
                                <span className="text-lg">📱</span>
                                <div>
                                    <strong>Mobile Friendly</strong>
                                    <p className="text-muted-foreground">Optimized for phones and tablets</p>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}