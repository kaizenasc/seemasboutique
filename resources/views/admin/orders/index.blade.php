@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Orders ({{ $orders->total() }})</h2>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-secondary' }}">All</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-secondary' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="btn btn-sm {{ request('status') == 'confirmed' ? 'btn-primary' : 'btn-secondary' }}">Confirmed</a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="btn btn-sm {{ request('status') == 'shipped' ? 'btn-primary' : 'btn-secondary' }}">Shipped</a>
            <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="btn btn-sm {{ request('status') == 'delivered' ? 'btn-primary' : 'btn-secondary' }}">Delivered</a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        {{ $order->customer_phone }}
                        <br>
                        <a href="{{ route('admin.orders.customerWhatsapp', $order) }}" target="_blank" class="btn btn-sm" style="background: #25D366; color: white; margin-top: 5px;">
                            💬 WhatsApp
                        </a>
                    </td>
                    <td><strong style="color: #c2185b;">₹{{ number_format($order->total, 2) }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ strtoupper($order->payment_method) }}</span>
                        @if($order->payment_method == 'upi' && $order->upi_utr)
                            <br><small>UTR: {{ $order->upi_utr }}</small>
                        @endif
                    </td>
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
                    <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: #666;">
                        No orders found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>

@endsection