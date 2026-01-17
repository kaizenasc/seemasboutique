@extends('layouts.admin')

@section('page-title', 'Create Coupon')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Create New Coupon</h2>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">← Back to Coupons</a>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Coupon Code <span style="color: #dc3545;">*</span></label>
            <input type="text" name="code" class="form-control" placeholder="e.g., SAVE20" required value="{{ old('code') }}" style="text-transform: uppercase;">
            <small style="color: #666; font-size: 13px;">This code will be used by customers at checkout</small>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Discount Type <span style="color: #dc3545;">*</span></label>
                <select name="type" id="discountType" class="form-control" required>
                    <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Discount Value <span style="color: #dc3545;">*</span></label>
                <input type="number" step="0.01" name="value" class="form-control" placeholder="e.g., 20" required value="{{ old('value') }}">
                <small style="color: #666; font-size: 13px;" id="valueHint">Enter percentage value (e.g., 20 for 20%)</small>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Usage Limit <span style="color: #dc3545;">*</span></label>
                <input type="number" name="usage_limit" class="form-control" placeholder="e.g., 100" required value="{{ old('usage_limit', 100) }}" min="1">
                <small style="color: #666; font-size: 13px;">Maximum number of times this coupon can be used</small>
            </div>

            <div class="form-group">
                <label>Minimum Order Amount (₹)</label>
                <input type="number" step="0.01" name="minimum_order" class="form-control" placeholder="e.g., 1000" value="{{ old('minimum_order') }}">
                <small style="color: #666; font-size: 13px;">Leave blank for no minimum</small>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Valid From</label>
                <input type="date" name="valid_from" class="form-control" value="{{ old('valid_from') }}">
                <small style="color: #666; font-size: 13px;">Leave blank for immediate activation</small>
            </div>

            <div class="form-group">
                <label>Valid Until</label>
                <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}">
                <small style="color: #666; font-size: 13px;">Leave blank for no expiry</small>
            </div>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="is_active" id="is_active" checked>
            <label for="is_active">Active (coupon can be used)</label>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Create Coupon</button>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('discountType').addEventListener('change', function() {
        const hint = document.getElementById('valueHint');
        if (this.value === 'percentage') {
            hint.textContent = 'Enter percentage value (e.g., 20 for 20%)';
        } else {
            hint.textContent = 'Enter fixed discount amount in rupees (e.g., 500)';
        }
    });
</script>
@endpush

@endsection