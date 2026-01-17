@extends('layouts.app')

@section('title', 'Checkout - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .checkout-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 40px 20px;
        text-align: center;
    }

    .checkout-header h1 {
        font-size: 36px;
        font-weight: 700;
    }

    .checkout-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }

    .checkout-form {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f5f5f5;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .form-group label span {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #c2185b;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .payment-methods {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .payment-option {
        flex: 1;
        padding: 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
    }

    .payment-option input[type="radio"] {
        display: none;
    }

    .payment-option:hover {
        border-color: #c2185b;
    }

    .payment-option input[type="radio"]:checked + label {
        color: #c2185b;
    }

    .payment-option.selected {
        border-color: #c2185b;
        background: #fff5f8;
    }

    .payment-option-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .payment-option-desc {
        font-size: 12px;
        color: #666;
    }

    .upi-details {
        display: none;
        margin-top: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .upi-details.active {
        display: block;
    }

    .order-summary {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .order-summary h2 {
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5f5f5;
    }

    .order-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f5f5f5;
        align-items: flex-start;
    }

    .order-item:last-child {
        border-bottom: none;
        margin-bottom: 20px;
    }

    .order-item-image {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        flex-shrink: 0;
    }

    .order-item-details {
        flex: 1;
        min-width: 0;
    }

    .order-item-name {
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
        font-weight: 500;
    }

    .order-item-meta {
        font-size: 12px;
        color: #666;
    }

    .order-item-price {
        font-weight: 600;
        color: #c2185b;
        white-space: nowrap;
        flex-shrink: 0;
        font-size: 14px;
    }

    .coupon-section {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .coupon-input-group {
        display: flex;
        gap: 10px;
    }

    .coupon-input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .apply-coupon-btn {
        padding: 10px 20px;
        background: #c2185b;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
    }

    .apply-coupon-btn:hover {
        background: #880e4f;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .discount-row {
        color: #28a745;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f5f5f5;
        font-size: 20px;
        font-weight: 700;
    }

    .place-order-btn {
        width: 100%;
        padding: 18px;
        background: #c2185b;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 20px;
    }

    .place-order-btn:hover {
        background: #880e4f;
    }

    @media (max-width: 992px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .payment-methods {
            flex-direction: column;
        }

        .order-summary {
            position: relative;
        }
    }
    
    @media (min-width: 993px) {
        .checkout-container {
            grid-template-columns: 1fr 400px !important;
        }
    }
</style>
@endpush

<div class="checkout-header">
    <h1>Checkout</h1>
</div>

<div class="checkout-container">


    <div class="order-summary">
        <h2>Order Summary</h2>

        @php
            $subtotal = 0;
        @endphp

        @foreach($cart as $item)
            @php
                $subtotal += $item['price'] * $item['quantity'];
            @endphp
            <div class="order-item">
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="order-item-image">
                <div class="order-item-details">
                    <div class="order-item-name">{{ $item['name'] }}</div>
                    <div class="order-item-meta">Size: {{ $item['size'] }} | Qty: {{ $item['quantity'] }}</div>
                </div>
                <div class="order-item-price">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
            </div>
        @endforeach

        <div class="coupon-section">
            <form action="{{ route('checkout.applyCoupon') }}" method="POST">
                @csrf
                <div class="coupon-input-group">
                    <input type="text" name="coupon_code" class="coupon-input" placeholder="Enter coupon code" value="{{ session('coupon')['code'] ?? '' }}">
                    <button type="submit" class="apply-coupon-btn">Apply</button>
                </div>
            </form>
            @if(session('coupon'))
                <form action="{{ route('checkout.removeCoupon') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; text-decoration: underline; font-size: 13px;">Remove Coupon</button>
                </form>
            @endif
        </div>

        <div class="summary-row">
            <span>Subtotal</span>
            <span>Rs. {{ number_format($subtotal, 2) }}</span>
        </div>

        @if(session('coupon'))
        <div class="summary-row discount-row">
            <span>Discount ({{ session('coupon')['code'] }})</span>
            <span>- Rs. {{ number_format(session('coupon')['discount'], 2) }}</span>
        </div>
        @endif

        <div class="summary-row">
            <span>Shipping</span>
            <span style="color: #28a745; font-weight: 600;">FREE</span>
        </div>

        @php
            $discount = session('coupon')['discount'] ?? 0;
            $finalTotal = $subtotal - $discount;
        @endphp

        <div class="summary-total">
            <span>Total</span>
            <span style="color: #c2185b;">Rs. {{ number_format($finalTotal, 2) }}</span>
        </div>
    </div>

    <!-- LEFT SIDE: Customer Form -->
    <div class="checkout-form">
        <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="section-title">Customer Information</div>

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name <span>*</span></label>
                    <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name') }}">
                </div>

                <div class="form-group">
                    <label>Phone Number <span>*</span></label>
                    <input type="tel" name="customer_phone" class="form-control" required value="{{ old('customer_phone') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Email Address (Optional)</label>
                <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}">
            </div>

            <div class="section-title" style="margin-top: 30px;">Shipping Address</div>

            <div class="form-group">
                <label>Address <span>*</span></label>
                <textarea name="customer_address" class="form-control" required>{{ old('customer_address') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>City <span>*</span></label>
                    <input type="text" name="city" class="form-control" required value="{{ old('city') }}">
                </div>

                <div class="form-group">
                    <label>State <span>*</span></label>
                    <input type="text" name="state" class="form-control" required value="{{ old('state') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Pincode <span>*</span></label>
                <input type="text" name="pincode" class="form-control" required value="{{ old('pincode') }}">
            </div>

            <div class="section-title" style="margin-top: 30px;">Payment Method</div>

            <div class="payment-methods">
                <div class="payment-option" onclick="selectPayment('cod')">
                    <input type="radio" name="payment_method" value="cod" id="cod" required>
                    <label for="cod">
                        <div class="payment-option-title">💵 Cash on Delivery</div>
                        <div class="payment-option-desc">Pay when you receive</div>
                    </label>
                </div>

                <div class="payment-option" onclick="selectPayment('upi')">
                    <input type="radio" name="payment_method" value="upi" id="upi">
                    <label for="upi">
                        <div class="payment-option-title">📱 UPI Payment</div>
                        <div class="payment-option-desc">Pay via UPI</div>
                    </label>
                </div>
            </div>

            <div class="upi-details" id="upiDetails">
                <p style="font-weight: 600; margin-bottom: 15px;">📱 Scan QR Code & Pay</p>
                <div style="background: white; padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 15px;">
                    <div style="display: inline-block; padding: 10px; background: white;">
                        {!! $qrCode !!}
                    </div>
                    
                    <p style="margin-top: 15px; font-weight: 600; color: #0c2d48; font-size: 20px;">
                        Amount: ₹{{ number_format($total, 2) }}
                    </p>
                </div>
                
                <p style="font-size: 14px; color: #666; margin-top: 10px;">
                    <strong>UPI ID:</strong> pratikpunjabi3@ybl
                </p>
                <p style="margin-bottom: 15px;">
                    Seemas Boutique
                </p>

                <div class="form-group">
                    <label>Enter UPI Transaction ID (UTR) <span>*</span></label>
                    <input type="text" name="upi_utr" class="form-control" placeholder="e.g., 123456789012">
                    <small style="color: #666; font-size: 12px;">Enter the 12-digit transaction ID from your payment app</small>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Order Notes (Optional)</label>
                <textarea name="notes" class="form-control" placeholder="Any special instructions for your order">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="place-order-btn">Place Order</button>
        </form>
    </div>

    <!-- RIGHT SIDE: Order Summary -->
    
</div>

@push('scripts')
<script>
    function selectPayment(method) {
        // Remove selected class from all options
        document.querySelectorAll('.payment-option').forEach(option => {
            option.classList.remove('selected');
        });

        // Add selected class to clicked option
        event.currentTarget.classList.add('selected');

        // Check the radio button
        document.getElementById(method).checked = true;

        // Show/hide UPI details
        const upiDetails = document.getElementById('upiDetails');
        const upiUtrInput = document.querySelector('input[name="upi_utr"]');
        
        if (method === 'upi') {
            upiDetails.classList.add('active');
            upiUtrInput.required = true;
        } else {
            upiDetails.classList.remove('active');
            upiUtrInput.required = false;
        }
    }

    // Set default payment method
    document.addEventListener('DOMContentLoaded', function() {
        const codOption = document.querySelector('.payment-option');
        if (codOption) {
            codOption.classList.add('selected');
            document.getElementById('cod').checked = true;
        }
    });
</script>
@endpush

@endsection