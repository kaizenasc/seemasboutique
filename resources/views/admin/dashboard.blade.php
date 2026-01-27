@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalOrders }}</h3>
            <p>Total Orders</p>
        </div>
        <div class="stat-icon">📦</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>
        <div class="stat-icon">🛍️</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalCategories }}</h3>
            <p>Categories</p>
        </div>
        <div class="stat-icon">🏷️</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>₹{{ number_format($totalRevenue, 2) }}</h3>
            <p>Total Revenue</p>
        </div>
        <div class="stat-icon">💰</div>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
    <div class="stat-card" style="background: #fff3cd; border-left: 4px solid #ffc107;">
        <div class="stat-info">
            <h3 style="color: #856404;">{{ $pendingOrders }}</h3>
            <p style="color: #856404;">Pending Orders</p>
        </div>
        <div class="stat-icon" style="background: #ffc107;">⏳</div>
    </div>

    <div class="stat-card" style="background: #f8d7da; border-left: 4px solid #dc3545;">
        <div class="stat-info">
            <h3 style="color: #721c24;">{{ $pendingPayments }}</h3>
            <p style="color: #721c24;">Pending Payments</p>
        </div>
        <div class="stat-icon" style="background: #dc3545;">💳</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All Orders</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                    <td>
                        <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->order_status == 'delivered' ? 'success' : 'info' }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #666;">
                        No orders yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Top Selling Products</h2>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Orders</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $product)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('uploads/' . $product->primary_image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            <span>{{ $product->name }}</span>
                        </div>
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td><strong>₹{{ number_format($product->price, 2) }}</strong></td>
                    <td><span class="badge badge-success">{{ $product->order_items_count }} orders</span></td>
                    <td>{{ $product->view_count }} views</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #666;">
                        No products yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection