@extends('layouts.app')

@section('title', 'Shopping Cart - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .cart-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 40px 20px;
        text-align: center;
    }

    .cart-header h1 {
        font-size: 36px;
        font-weight: 700;
    }

    .cart-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }

    .cart-items {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .cart-item {
        display: grid;
        grid-template-columns: 120px 1fr auto;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        width: 120px;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
    }

    .cart-item-details h3 {
        font-size: 16px;
        margin-bottom: 8px;
        color: #333;
    }

    .cart-item-size {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .cart-item-price {
        font-size: 18px;
        font-weight: 700;
        color: #c2185b;
        margin-bottom: 15px;
    }

    .cart-item-quantity {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
        transition: all 0.3s;
    }

    .qty-btn:hover {
        background: #c2185b;
        color: white;
        border-color: #c2185b;
    }

    .qty-display {
        width: 50px;
        text-align: center;
        font-weight: 600;
    }

    .cart-item-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }

    .remove-btn {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 14px;
        text-decoration: underline;
        transition: color 0.3s;
    }

    .remove-btn:hover {
        color: #c82333;
    }

    .item-total {
        font-size: 20px;
        font-weight: 700;
        color: #333;
    }

    .cart-summary {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .cart-summary h2 {
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5f5f5;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 15px;
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

    .checkout-btn {
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
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .checkout-btn:hover {
        background: #880e4f;
    }

    .continue-shopping {
        width: 100%;
        padding: 15px;
        background: white;
        color: #c2185b;
        border: 2px solid #c2185b;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 15px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .continue-shopping:hover {
        background: #c2185b;
        color: white;
    }

    .empty-cart {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-cart-icon {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-cart h2 {
        font-size: 28px;
        margin-bottom: 15px;
        color: #333;
    }

    .empty-cart p {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .cart-container {
            grid-template-columns: 1fr;
        }

        .cart-item {
            grid-template-columns: 80px 1fr;
            gap: 15px;
        }

        .cart-item-image {
            width: 80px;
            height: 107px;
        }

        .cart-item-actions {
            grid-column: 1 / -1;
            flex-direction: row;
            justify-content: space-between;
        }

        .cart-summary {
            position: relative;
        }
    }
</style>
@endpush

<div class="cart-header">
    <h1>Shopping Cart</h1>
</div>

@if(empty($cart) || count($cart) == 0)
    <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <h2>Your cart is empty</h2>
        <p>Add some products to get started!</p>
        <a href="{{ route('shop') }}" class="btn-primary" style="padding: 15px 40px; text-decoration: none; display: inline-block;">Start Shopping</a>
    </div>
@else
<div class="cart-container">
    <div class="cart-items">
        <h2 style="margin-bottom: 25px; font-size: 24px;">Cart Items ({{ count($cart) }})</h2>
        
        @php
            $subtotal = 0;
        @endphp

        @foreach($cart as $key => $item)
            @php
                $itemTotal = $item['price'] * $item['quantity'];
                $subtotal += $itemTotal;
            @endphp

            <div class="cart-item">
                <img src="{{ productImage($item['image']) }}" alt="{{ $item['name'] }}" class="cart-item-image">
                
                <div class="cart-item-details">
                    <h3>{{ $item['name'] }}</h3>
                    <div class="cart-item-size">Size: {{ $item['size'] }}</div>
                    <div class="cart-item-price">Rs. {{ number_format($item['price'], 2) }}</div>
                    
                    <form action="{{ route('cart.update', $key) }}" method="POST" class="cart-item-quantity">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="qty-btn" onclick="updateQuantity('{{ $key }}', {{ $item['quantity'] - 1 }})">−</button>
                        <span class="qty-display">{{ $item['quantity'] }}</span>
                        <button type="button" class="qty-btn" onclick="updateQuantity('{{ $key }}', {{ $item['quantity'] + 1 }})">+</button>
                    </form>
                </div>

                <div class="cart-item-actions">
                    <form action="{{ route('cart.remove', $key) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                    <div class="item-total">Rs. {{ number_format($itemTotal, 2) }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="cart-summary">
        <h2>Order Summary</h2>
        
        <div class="summary-row">
            <span>Subtotal ({{ count($cart) }} items)</span>
            <span>Rs. {{ number_format($subtotal, 2) }}</span>
        </div>
        
        <div class="summary-row">
            <span>Shipping</span>
            <span style="color: #28a745; font-weight: 600;">FREE</span>
        </div>
        
        <div class="summary-total">
            <span>Total</span>
            <span style="color: #c2185b;">Rs. {{ number_format($subtotal, 2) }}</span>
        </div>

        <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
        <a href="{{ route('shop') }}" class="continue-shopping">Continue Shopping</a>
    </div>
</div>
@endif

@push('scripts')
<script>
    function updateQuantity(key, quantity) {
        if (quantity < 1) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/cart/update/' + key;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.content;
            form.appendChild(csrfInput);
        }
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PATCH';
        form.appendChild(methodInput);
        
        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'quantity';
        qtyInput.value = quantity;
        form.appendChild(qtyInput);
        
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endpush

@endsection