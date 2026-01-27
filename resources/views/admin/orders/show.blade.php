@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Order #{{ $order->order_number }}</h2>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
            </div>

            <div style="padding: 20px; border-bottom: 1px solid #eee;">
                <h3 style="font-size: 18px; margin-bottom: 15px;">Customer Information</h3>
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $order->customer_address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</p>
            </div>

            <div style="padding: 20px;">
                <h3 style="font-size: 18px; margin-bottom: 15px;">Order Items</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($item->product)
                                        <img src="{{ productImage($item->product->primary_image) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    @endif
                                    <span>{{ $item->product_name }}</span>
                                </div>
                            </td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td><strong>₹{{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="text-align: right; margin-top: 20px;">
                    <p><strong>Subtotal:</strong> ₹{{ number_format($order->subtotal, 2) }}</p>
                    @if($order->discount > 0)
                        <p style="color: #28a745;"><strong>Discount ({{ $order->coupon_code }}):</strong> - ₹{{ number_format($order->discount, 2) }}</p>
                    @endif
                    <h3 style="color: #c2185b; font-size: 24px; margin-top: 10px;">Total: ₹{{ number_format($order->total, 2) }}</h3>
                </div>
            </div>

            @if($order->notes)
            <div style="padding: 20px; border-top: 1px solid #eee; background: #f8f9fa;">
                <strong>Order Notes:</strong>
                <p>{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 18px;">Update Status</h3>
            </div>

            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="margin-bottom: 20px;">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Order Status</label>
                    <select name="order_status" class="form-control" required>
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">Update Order Status</button>
            </form>

            @if($order->payment_method == 'upi')
            <form action="{{ route('admin.orders.updatePaymentStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Payment Status</label>
                    <select name="payment_status" class="form-control" required>
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                @if($order->upi_utr)
                    <p style="font-size: 13px; color: #666; margin-bottom: 15px;"><strong>UTR:</strong> {{ $order->upi_utr }}</p>
                @endif
                <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Update Payment Status</button>
            </form>
            @endif
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3 class="card-title" style="font-size: 18px;">Quick Actions</h3>
            </div>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="{{ route('admin.orders.customerWhatsapp', $order) }}" target="_blank" class="btn btn-success" style="background: #25D366;">
                    💬 Message Customer
                </a>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div style="padding: 20px;">
                <h3 style="font-size: 16px; margin-bottom: 15px;">Order Info</h3>
                <p style="font-size: 14px; margin-bottom: 10px;"><strong>Order Date:</strong><br>{{ $order->created_at->format('d M, Y h:i A') }}</p>
                <p style="font-size: 14px; margin-bottom: 10px;"><strong>Payment Method:</strong><br>{{ strtoupper($order->payment_method) }}</p>
                <p style="font-size: 14px;"><strong>Payment Status:</strong><br>
                    <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection