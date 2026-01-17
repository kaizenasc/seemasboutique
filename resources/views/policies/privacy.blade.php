@extends('layouts.app')

@section('title', 'Privacy Policy - Seema\'s Boutique')

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
    <h1>Privacy Policy</h1>
</div>

<div class="policy-content">
    <h2>Information We Collect</h2>
    <p>We collect information you provide when placing an order, including your name, phone number, email address, and delivery address.</p>

    <h2>How We Use Your Information</h2>
    <p>We use your information to:</p>
    <ul>
        <li>Process and fulfill your orders</li>
        <li>Communicate with you about your orders</li>
        <li>Send order updates via WhatsApp or SMS</li>
        <li>Improve our products and services</li>
    </ul>

    <h2>Data Security</h2>
    <p>We take appropriate security measures to protect your personal information. Your payment information is not stored on our servers.</p>

    <h2>Information Sharing</h2>
    <p>We do not sell, trade, or share your personal information with third parties except as necessary to fulfill your orders (e.g., shipping partners).</p>

    <h2>Contact Us</h2>
    <p>If you have questions about our Privacy Policy, please contact us at care@seemasboutique.in or call +91-7058666655.</p>
</div>

@endsection