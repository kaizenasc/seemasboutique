@extends('layouts.app')

@section('title', 'Order Placed Successfully - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .success-container {
        max-width: 800px;
        margin: 60px auto;
        padding: 0 20px;
        text-align: center;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 50px;
        color: white;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }

    .success-container h1 {
        font-size: 36px;
        margin-bottom: 15px;
        color: #28a745;
    }

    .success-container p {
        font-size: 18px;
        color: #666;
        margin-bottom: 30px;
    }

    .order-details-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        text-align: left;
    }

    .order-number {
        font-size: 24px;
        font-weight: 700;
        color: #c2185b;
        margin-bottom: 20px;
        text-align: center;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #333;
    }

    .detail-value {
        color: #666;
    }

    .order-items {
        margin-top: 30px;
    }

    .order-items h3 {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5f5f5;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .item-meta {
        font-size: 14px;
        color: #666;
    }

    .item-price {
        font-weight: 700;
        color: #c2185b;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f5f5f5;
        font-size: 24px;
        font-weight: 700;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .btn {
        padding: 15px 30px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #c2185b;
        color: white;
    }

    .btn-primary:hover {
        background: #880e4f;
    }

    .btn-secondary {
        background: white;
        color: #c2185b;
        border: 2px solid #c2185b;
    }

    .btn-secondary:hover {
        background: #c2185b;
        color: white;
    }

    .payment-status {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .status-paid {
        background: #d4edda;
        color: #155724;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    @media (max-width: 768px) {
        .success-container h1 {
            font-size: 28px;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>
@endpush

<div class="success-container">
    <div class="success-icon">✓</div>
    <h1>Order Placed Successfully!</h1>
    <p>Thank you for shopping with Seema's Boutique. Your order has been received.</p>

    <div class="order-details-card">
        <div class="order-number">Order #{{ $order->order_number }}</div>

        <div class="detail-row">
            <span class="detail-label">Order Date:</span>
            <span class="detail-value">{{ $order->created_at->format('d M, Y h:i A') }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Customer Name:</span>
            <span class="detail-value">{{ $order->customer_name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Phone:</span>
            <span class="detail-value">{{ $order->customer_phone }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Delivery Address:</span>
            <span class="detail-value">{{ $order->customer_address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Payment Method:</span>
            <span class="detail-value">{{ strtoupper($order->payment_method) }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Payment Status:</span>
            <span class="payment-status {{ $order->payment_status == 'paid' ? 'status-paid' : 'status-pending' }}">
                {{ ucfirst($order->payment_status) }}
            </span>
        </div>

        @if($order->payment_method == 'upi' && $order->payment_status == 'pending')
        <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin-top: 20px; font-size: 14px;">
            <strong>⚠️ Payment Pending:</strong> Your order is under review. We will confirm your payment and update the status within 24 hours.
        </div>
        @endif

        <div class="order-items">
            <h3>Order Items</h3>
            @foreach($order->items as $item)
            <div class="order-item">
                <div class="item-info">
                    <div class="item-name">{{ $item->product_name }}</div>
                    <div class="item-meta">Size: {{ $item->size }} | Quantity: {{ $item->quantity }}</div>
                </div>
                <div class="item-price">Rs. {{ number_format($item->price * $item->quantity, 2) }}</div>
            </div>
            @endforeach

            <div class="order-total">
                <span>Total Amount:</span>
                <span style="color: #c2185b;">Rs. {{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="btn-group">
        <a href="{{ route('order.track') }}" class="btn btn-primary">Track Order</a>
        <a href="{{ route('shop') }}" class="btn btn-secondary">Continue Shopping</a>
    </div>
</div>

@endsection