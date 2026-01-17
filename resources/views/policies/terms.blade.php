@extends('layouts.app')

@section('title', 'Terms & Conditions - Seema\'s Boutique')

@section('content')
<style>
    .policy-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .policy-header h1 {
        font-size: 36px;
        font-weight: 700;
    }

    .policy-content {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .policy-content h2 {
        color: #c2185b;
        font-size: 24px;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .policy-content h2:first-child {
        margin-top: 0;
    }

    .policy-content p {
        margin-bottom: 15px;
        line-height: 1.8;
        color: #666;
    }

    .policy-content ul {
        margin-left: 20px;
        margin-bottom: 15px;
        color: #666;
    }

    .policy-content li {
        margin-bottom: 8px;
        line-height: 1.6;
    }
</style>

<div class="policy-header">
    <h1>Terms & Conditions</h1>
</div>

<div class="policy-content">
    <h2>Acceptance of Terms</h2>
    <p>By using our website and placing orders, you agree to these terms and conditions.</p>

    <h2>Product Information</h2>
    <p>We make every effort to display product colors and details accurately. However, actual colors may vary slightly due to screen settings.</p>

    <h2>Pricing</h2>
    <p>All prices are in Indian Rupees (₹) and are subject to change without notice. We reserve the right to modify prices at any time.</p>

    <h2>Order Acceptance</h2>
    <p>We reserve the right to accept or reject any order. In case of order cancellation, full refund will be processed.</p>

    <h2>Payment</h2>
    <p>We accept Cash on Delivery (COD) and UPI payments. For UPI orders, payment verification is required before order processing.</p>

    <h2>Shipping</h2>
    <p>We ship across India. Delivery time is typically 5-7 business days. Shipping is free on all orders.</p>

    <h2>Limitation of Liability</h2>
    <p>Seema's Boutique is not liable for any indirect, incidental, or consequential damages arising from the use of our products or services.</p>

    <h2>Contact</h2>
    <p>For any questions, contact us at care@seemasboutique.in or +91-7058666655.</p>
</div>

@endsection