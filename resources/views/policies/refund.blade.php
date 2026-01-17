@extends('layouts.app')

@section('title', 'Refund Policy - Seema\'s Boutique')

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
    <h1>Refund Policy</h1>
</div>

<div class="policy-content">
    <h2>7-Day Return & Exchange</h2>
    <p>We offer a 7-day return and exchange policy from the date of delivery. Items must be unused, unwashed, and in original condition with all tags attached.</p>

    <h2>Eligible for Return/Exchange</h2>
    <ul>
        <li>Damaged or defective products</li>
        <li>Wrong item delivered</li>
        <li>Size exchange (subject to availability)</li>
    </ul>

    <h2>Non-Returnable Items</h2>
    <ul>
        <li>Products without original tags or packaging</li>
        <li>Worn, altered, or washed items</li>
        <li>Sale or discounted items (unless defective)</li>
    </ul>

    <h2>Refund Process</h2>
    <p>Refunds will be processed within 5-7 business days after we receive and inspect the returned item. Refunds will be credited to the original payment method.</p>

    <h2>How to Initiate Return</h2>
    <p>Contact us at +91-7058666655 or email care@seemasboutique.in with your order number and reason for return.</p>
</div>

@endsection