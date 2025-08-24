import React from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Link } from '@inertiajs/react';

export default function Welcome() {
    const features = [
        {
            icon: '📦',
            title: 'Stock Management',
            description: 'Track inventory levels, stock movements, and maintain accurate counts across all products'
        },
        {
            icon: '🏬',
            title: 'Multi-Warehouse',
            description: 'Manage inventory across multiple warehouse locations with location mapping'
        },
        {
            icon: '⚠️',
            title: 'Low Stock Alerts',
            description: 'Automatic notifications when products fall below minimum stock levels'
        },
        {
            icon: '📊',
            title: 'Stock Reporting',
            description: 'Detailed reports on stock movements, inventory levels, and historical data'
        },
        {
            icon: '🤝',
            title: 'Supplier Management',
            description: 'Maintain supplier profiles and track purchase history for better procurement'
        },
        {
            icon: '🔄',
            title: 'Stock Transfers',
            description: 'Transfer inventory between warehouses with complete audit trails'
        }
    ];

    const themes = [
        { name: 'Professional Blue', color: 'bg-blue-500' },
        { name: 'Construction Red', color: 'bg-red-500' },
        { name: 'Industrial Orange', color: 'bg-orange-500' },
        { name: 'Nature Green', color: 'bg-green-500' }
    ];

    return (
        <div className="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800">
            {/* Hero Section */}
            <div className="container mx-auto px-4 pt-16 pb-8">
                <div className="text-center max-w-4xl mx-auto">
                    <div className="flex items-center justify-center gap-3 mb-6">
                        <span className="text-6xl">🏗️</span>
                        <h1 className="text-4xl md:text-6xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            BuildStock IMS
                        </h1>
                    </div>
                    <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 font-medium">
                        Professional Inventory Management System for Building Materials Stores
                    </p>
                    <p className="text-lg text-gray-500 dark:text-gray-400 mb-12">
                        Streamline your construction materials inventory with comprehensive stock management, 
                        multi-warehouse support, and real-time reporting designed for building supply businesses.
                    </p>
                    
                    <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Button asChild size="lg" className="px-8 py-6 text-lg">
                            <Link href="/login">
                                🚀 Access Dashboard
                            </Link>
                        </Button>
                        <Button asChild variant="outline" size="lg" className="px-8 py-6 text-lg">
                            <Link href="/register">
                                📝 Create Account
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>

            {/* Features Grid */}
            <div className="container mx-auto px-4 py-16">
                <div className="text-center mb-12">
                    <h2 className="text-3xl font-bold mb-4">🌟 Complete Inventory Solution</h2>
                    <p className="text-xl text-gray-600 dark:text-gray-300">
                        Everything you need to manage building materials inventory efficiently
                    </p>
                </div>

                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {features.map((feature, index) => (
                        <Card key={index} className="h-full hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <div className="flex items-center gap-3">
                                    <span className="text-3xl">{feature.icon}</span>
                                    <CardTitle className="text-xl">{feature.title}</CardTitle>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <CardDescription className="text-base leading-relaxed">
                                    {feature.description}
                                </CardDescription>
                            </CardContent>
                        </Card>
                    ))}
                </div>
            </div>

            {/* Product Categories Preview */}
            <div className="container mx-auto px-4 py-16 bg-white/50 dark:bg-slate-800/50">
                <div className="text-center mb-12">
                    <h2 className="text-3xl font-bold mb-4">🏗️ Built for Construction Materials</h2>
                    <p className="text-xl text-gray-600 dark:text-gray-300">
                        Specialized for the building materials industry
                    </p>
                </div>

                <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                    {[
                        { name: 'Cement & Concrete', icon: '🏭', color: 'bg-gray-100' },
                        { name: 'Steel & Rebar', icon: '🔩', color: 'bg-slate-100' },
                        { name: 'Aggregates', icon: '🪨', color: 'bg-stone-100' },
                        { name: 'Blocks & Bricks', icon: '🧱', color: 'bg-red-100' },
                        { name: 'Roofing Materials', icon: '🏠', color: 'bg-blue-100' },
                        { name: 'Plumbing Supplies', icon: '🔧', color: 'bg-cyan-100' },
                        { name: 'Electrical Supplies', icon: '⚡', color: 'bg-yellow-100' },
                        { name: 'Hardware & Tools', icon: '🔨', color: 'bg-orange-100' }
                    ].map((category, index) => (
                        <div key={index} className={`p-4 rounded-lg text-center ${category.color} dark:bg-slate-700`}>
                            <div className="text-2xl mb-2">{category.icon}</div>
                            <p className="text-xs font-medium">{category.name}</p>
                        </div>
                    ))}
                </div>
            </div>

            {/* Theme Options */}
            <div className="container mx-auto px-4 py-16">
                <div className="text-center mb-12">
                    <h2 className="text-3xl font-bold mb-4">🎨 Customizable Themes</h2>
                    <p className="text-xl text-gray-600 dark:text-gray-300">
                        Choose from multiple color themes to match your brand
                    </p>
                </div>

                <div className="flex justify-center gap-4 flex-wrap">
                    {themes.map((theme, index) => (
                        <div key={index} className="text-center">
                            <div className={`w-16 h-16 rounded-full ${theme.color} mb-2 mx-auto shadow-lg`}></div>
                            <p className="text-sm font-medium">{theme.name}</p>
                        </div>
                    ))}
                </div>
            </div>

            {/* System Preview */}
            <div className="container mx-auto px-4 py-16 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/20 dark:to-indigo-950/20">
                <div className="text-center mb-12">
                    <h2 className="text-3xl font-bold mb-4">📱 Mobile-First Design</h2>
                    <p className="text-xl text-gray-600 dark:text-gray-300">
                        Access your inventory from anywhere - desktop, tablet, or mobile
                    </p>
                </div>

                <div className="max-w-4xl mx-auto">
                    <Card className="p-8">
                        <div className="grid md:grid-cols-3 gap-6">
                            <div className="text-center">
                                <div className="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">📊</span>
                                </div>
                                <h3 className="font-bold mb-2">Real-time Analytics</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Live dashboard with stock levels, alerts, and movement tracking
                                </p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">📱</span>
                                </div>
                                <h3 className="font-bold mb-2">Mobile Optimized</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Responsive design works perfectly on all devices and screen sizes
                                </p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-20 h-20 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">🔒</span>
                                </div>
                                <h3 className="font-bold mb-2">Secure & Reliable</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    User authentication, role-based access, and data protection
                                </p>
                            </div>
                        </div>
                    </Card>
                </div>
            </div>

            {/* CTA Section */}
            <div className="container mx-auto px-4 py-16 text-center">
                <Card className="max-w-2xl mx-auto p-8 bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-0">
                    <CardHeader>
                        <CardTitle className="text-3xl text-white mb-4">
                            Ready to Optimize Your Inventory? 🚀
                        </CardTitle>
                        <CardDescription className="text-blue-100 text-lg">
                            Join building material stores already using BuildStock IMS to streamline their operations
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Button asChild size="lg" variant="outline" className="bg-white text-blue-600 hover:bg-blue-50 border-white">
                                <Link href="/register">
                                    🎯 Start Free Trial
                                </Link>
                            </Button>
                            <Button asChild size="lg" variant="outline" className="border-blue-200 text-white hover:bg-blue-700">
                                <Link href="/login">
                                    📋 View Demo
                                </Link>
                            </Button>
                        </div>
                        
                        <div className="mt-8 flex items-center justify-center gap-4 text-sm text-blue-100">
                            <Badge variant="secondary" className="bg-blue-500/20 text-blue-100 border-blue-400">
                                ✅ Multi-warehouse
                            </Badge>
                            <Badge variant="secondary" className="bg-blue-500/20 text-blue-100 border-blue-400">
                                ✅ Real-time alerts
                            </Badge>
                            <Badge variant="secondary" className="bg-blue-500/20 text-blue-100 border-blue-400">
                                ✅ Mobile friendly
                            </Badge>
                        </div>
                    </CardContent>
                </Card>
            </div>

            {/* Footer */}
            <div className="bg-slate-900 text-white py-8">
                <div className="container mx-auto px-4 text-center">
                    <div className="flex items-center justify-center gap-2 mb-4">
                        <span className="text-2xl">🏗️</span>
                        <span className="text-xl font-bold">BuildStock IMS</span>
                    </div>
                    <p className="text-slate-300">
                        Professional Inventory Management for Construction Materials
                    </p>
                    <p className="text-slate-400 text-sm mt-2">
                        © 2024 BuildStock IMS. Built with Laravel & React.
                    </p>
                </div>
            </div>
        </div>
    );
}