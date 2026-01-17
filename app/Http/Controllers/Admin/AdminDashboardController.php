<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $pendingPayments = Order::where('payment_status', 'pending')->count();
        
        $recentOrders = Order::with('items')->latest()->take(10)->get();
        
        // Monthly revenue - SQLite compatible
        $monthlyRevenue = [];
        
        // Top selling products
        $topProducts = Product::withCount('orderItems')
            ->with('category')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalRevenue',
            'pendingOrders',
            'pendingPayments',
            'recentOrders',
            'monthlyRevenue',
            'topProducts'
        ));
    }
}