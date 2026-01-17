@extends('layouts.app')

@section('title', 'Track Order - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .track-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 40px 20px;
        text-align: center;
    }

    .track-header h1 {
        font-size: 36px;
        font-weight: 700;
    }

    .track-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .track-form {
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        text-align: center;
    }

    .track-form h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .track-input-group {
        display: flex;
        gap: 15px;
        max-width: 500px;
        margin: 0 auto;
    }

    .track-input {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border 0.3s;
    }

    .track-input:focus {
        outline: none;
        border-color: #c2185b;
    }

    .track-btn {
        padding: 15px 40px;
        background: #c2185b;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .track-btn:hover {
        background: #880e4f;
    }

    .order-status-card {
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-top: 30px;
    }

    .status-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .order-id {
        font-size: 28px;
        font-weight: 700;
        color: #c2185b;
        margin-bottom: 10px;
    }

    .current-status {
        display: inline-block;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        margin-top: 10px;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-processing {
        background: #cfe2ff;
        color: #084298;
    }

    .status-shipped {
        background: #e7d4f7;
        color: #5a189a;
    }

    .status-delivered {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .status-timeline {
        position: relative;
        padding-left: 50px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 40px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -38px;
        width: 20px;
        height: 20px;
        background: #ddd;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 0 0 2px #ddd;
    }

    .timeline-dot.active {
        background: #c2185b;
        box-shadow: 0 0 0 2px #c2185b;
    }

    .timeline-line {
        position: absolute;
        left: -29px;
        top: 20px;
        width: 2px;
        height: 100%;
        background: #ddd;
    }

    .timeline-content h3 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #333;
    }

    .timeline-content p {
        color: #666;
        font-size: 14px;
    }

    .order-details {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid #f5f5f5;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    @media (max-width: 768px) {
        .track-input-group {
            flex-direction: column;
        }

        .order-status-card {
            padding: 25px;
        }
    }
</style>
@endpush

<div class="track-header">
    <h1>Track Your Order</h1>
</div>

<div class="track-container">
    @if(!isset($order))
    <div class="track-form">
        <h2>Enter Your Order Number</h2>
        <p style="color: #666; margin-bottom: 30px;">You can find your order number in the confirmation email or SMS</p>
        
        <form action="{{ route('order.track') }}" method="GET">
            <div class="track-input-group">
                <input type="text" name="order_number" class="track-input" placeholder="e.g., SM20250117ABCDEF" required>
                <button type="submit" class="track-btn">Track Order</button>
            </div>
        </form>
    </div>
    @else
    <div class="order-status-card">
        <div class="status-header">
            <div class="order-id">Order #{{ $order->order_number }}</div>
            <p style="color: #666; margin-bottom: 15px;">Placed on {{ $order->created_at->format('d M, Y') }}</p>
            <span class="current-status status-{{ $order->order_status }}">
                {{ ucfirst($order->order_status) }}
            </span>
        </div>

        <div class="status-timeline">
            <div class="timeline-item">
                <div class="timeline-dot active"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                    <h3>✓ Order Placed</h3>
                    <p>{{ $order->created_at->format('d M, Y h:i A') }}</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($order->order_status, ['confirmed', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                    <h3>{{ in_array($order->order_status, ['confirmed', 'processing', 'shipped', 'delivered']) ? '✓' : '' }} Order Confirmed</h3>
                    <p>{{ in_array($order->order_status, ['confirmed', 'processing', 'shipped', 'delivered']) ? 'Your order has been confirmed' : 'Waiting for confirmation' }}</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                    <h3>{{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? '✓' : '' }} Processing</h3>
                    <p>{{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'Your order is being prepared' : 'Order will be processed soon' }}</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($order->order_status, ['shipped', 'delivered']) ? 'active' : '' }}"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                    <h3>{{ in_array($order->order_status, ['shipped', 'delivered']) ? '✓' : '' }} Shipped</h3>
                    <p>{{ in_array($order->order_status, ['shipped', 'delivered']) ? 'Your order is on the way' : 'Order will be shipped soon' }}</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot {{ $order->order_status == 'delivered' ? 'active' : '' }}"></div>
                <div class="timeline-content">
                    <h3>{{ $order->order_status == 'delivered' ? '✓' : '' }} Delivered</h3>
                    <p>{{ $order->order_status == 'delivered' ? 'Order delivered successfully' : 'Estimated delivery in 5-7 days' }}</p>
                </div>
            </div>
        </div>

        <div class="order-details">
            <h3 style="font-size: 20px; margin-bottom: 20px;">Order Details</h3>
            
            <div class="detail-row">
                <span style="font-weight: 600;">Customer Name:</span>
                <span>{{ $order->customer_name }}</span>
            </div>

            <div class="detail-row">
                <span style="font-weight: 600;">Phone:</span>
                <span>{{ $order->customer_phone }}</span>
            </div>

            <div class="detail-row">
                <span style="font-weight: 600;">Delivery Address:</span>
                <span>{{ $order->customer_address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</span>
            </div>

            <div class="detail-row">
                <span style="font-weight: 600;">Payment Method:</span>
                <span>{{ strtoupper($order->payment_method) }}</span>
            </div>

            <div class="detail-row">
                <span style="font-weight: 600;">Total Amount:</span>
                <span style="color: #c2185b; font-weight: 700; font-size: 18px;">Rs. {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('shop') }}" style="padding: 12px 30px; background: #c2185b; color: white; text-decoration: none; border-radius: 8px; display: inline-block; font-weight: 600;">Continue Shopping</a>
        </div>
    </div>
    @endif
</div>

@endsection