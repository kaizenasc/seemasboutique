@extends('layouts.admin')

@section('page-title', 'Edit Coupon')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Coupon</h2>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">← Back to Coupons</a>
    </div>

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Coupon Code <span style="color: #dc3545;">*</span></label>
            <input type="text" name="code" class="form-control" required value="{{ old('code', $coupon->code) }}" style="text-transform: uppercase;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Discount Type <span style="color: #dc3545;">*</span></label>
                <select name="type" id="discountType" class="form-control" required>
                    <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Discount Value <span style="color: #dc3545;">*</span></label>
                <input type="number" step="0.01" name="value" class="form-control" required value="{{ old('value', $coupon->value) }}">
                <small style="color: #666; font-size: 13px;" id="valueHint">
                    @if($coupon->type == 'percentage')
                        Enter percentage value (e.g., 20 for 20%)
                    @else
                        Enter fixed discount amount in rupees
                    @endif
                </small>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Usage Limit <span style="color: #dc3545;">*</span></label>
                <input type="number" name="usage_limit" class="form-control" required value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1">
                <small style="color: #666; font-size: 13px;">Used: {{ $coupon->used_count }} times</small>
            </div>

            <div class="form-group">
                <label>Minimum Order Amount (₹)</label>
                <input type="number" step="0.01" name="minimum_order" class="form-control" value="{{ old('minimum_order', $coupon->minimum_order) }}">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Valid From</label>
                <input type="date" name="valid_from" class="form-control" value="{{ old('valid_from', $coupon->valid_from ? $coupon->valid_from->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label>Valid Until</label>
                <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d') : '') }}">
            </div>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="is_active" id="is_active" {{ $coupon->is_active ? 'checked' : '' }}>
            <label for="is_active">Active (coupon can be used)</label>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Update Coupon</button>
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