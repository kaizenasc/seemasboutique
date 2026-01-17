@extends('layouts.admin')

@section('page-title', 'Coupons')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Coupons</h2>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">+ Create Coupon</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Usage</th>
                    <th>Min. Order</th>
                    <th>Valid Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                <tr>
                    <td><strong style="font-size: 16px; color: #c2185b;">{{ $coupon->code }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ ucfirst($coupon->type) }}</span>
                    </td>
                    <td>
                        @if($coupon->type == 'percentage')
                            <strong>{{ $coupon->value }}%</strong>
                        @else
                            <strong>₹{{ number_format($coupon->value, 2) }}</strong>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $coupon->used_count >= $coupon->usage_limit ? 'danger' : 'success' }}">
                            {{ $coupon->used_count }} / {{ $coupon->usage_limit }}
                        </span>
                    </td>
                    <td>
                        @if($coupon->minimum_order)
                            ₹{{ number_format($coupon->minimum_order, 2) }}
                        @else
                            <span style="color: #999;">No minimum</span>
                        @endif
                    </td>
                    <td>
                        @if($coupon->valid_from && $coupon->valid_until)
                            {{ $coupon->valid_from->format('d M, Y') }}<br>to<br>{{ $coupon->valid_until->format('d M, Y') }}
                        @elseif($coupon->valid_from)
                            From {{ $coupon->valid_from->format('d M, Y') }}
                        @elseif($coupon->valid_until)
                            Until {{ $coupon->valid_until->format('d M, Y') }}
                        @else
                            <span style="color: #999;">No expiry</span>
                        @endif
                    </td>
                    <td>
                        @if($coupon->is_active && $coupon->isValid())
                            <span class="badge badge-success">Active</span>
                        @elseif(!$coupon->is_active)
                            <span class="badge badge-danger">Inactive</span>
                        @elseif($coupon->used_count >= $coupon->usage_limit)
                            <span class="badge badge-warning">Limit Reached</span>
                        @else
                            <span class="badge badge-warning">Expired</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display: inline-block; margin-top: 5px;" onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #666;">
                        No coupons yet. <a href="{{ route('admin.coupons.create') }}">Create your first coupon</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection