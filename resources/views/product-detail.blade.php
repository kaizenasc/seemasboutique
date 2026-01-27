@extends('layouts.app')

@section('title', $product->name . ' - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .product-detail-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
    }

    .product-images {
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .main-image {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .thumbnail-images {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .thumbnail {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border 0.3s;
    }

    .thumbnail:hover,
    .thumbnail.active {
        border-color: #c2185b;
    }

    .product-details h1 {
        font-size: 32px;
        margin-bottom: 15px;
        color: #333;
    }

    .product-category {
        color: #c2185b;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .product-price-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .price-current {
        font-size: 36px;
        font-weight: 700;
        color: #c2185b;
    }

    .price-old {
        font-size: 24px;
        color: #999;
        text-decoration: line-through;
    }

    .discount-badge {
        background: #c2185b;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .product-description {
        margin: 30px 0;
        line-height: 1.8;
        color: #666;
    }

    .size-selector {
        margin: 30px 0;
    }

    .size-selector h3 {
        margin-bottom: 15px;
        font-size: 16px;
        font-weight: 600;
    }

    .size-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .size-option {
        padding: 10px 20px;
        border: 2px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
    }

    .size-option:hover,
    .size-option.selected {
        border-color: #c2185b;
        background: #c2185b;
        color: white;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 30px 0;
    }

    .quantity-selector h3 {
        font-size: 16px;
        font-weight: 600;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 5px;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: white;
        cursor: pointer;
        font-size: 20px;
        transition: background 0.3s;
    }

    .qty-btn:hover {
        background: #f5f5f5;
    }

    .qty-input {
        width: 60px;
        height: 40px;
        border: none;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 18px;
        background: #000;
        color: white;
        border: none;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 20px;
    }

    .add-to-cart-btn:hover {
        background: #c2185b;
    }

    .add-to-cart-btn:disabled {
        background: #999;
        cursor: not-allowed;
    }

    .related-products {
        max-width: 1400px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .related-products h2 {
        font-size: 32px;
        margin-bottom: 30px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .product-detail-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .product-images {
            position: relative;
        }

        .product-details h1 {
            font-size: 24px;
        }

        .price-current {
            font-size: 28px;
        }
    }
</style>
@endpush

<div class="product-detail-container">
    <div class="product-images">
        <img src="{{ productImage($product->primary_image) }}" alt="{{ $product->name }}" class="main-image" id="mainImage">
        
        @if($product->images->count() > 0)
<div class="thumbnail-images">
    <img src="{{ productImage($product->primary_image) }}" class="thumbnail active" onclick="changeImage(this)">
    @foreach($product->images as $image)
        <img src="{{ productImage($image->image_path) }}" class="thumbnail" onclick="changeImage(this)">
    @endforeach
</div>
@endif
    </div>

    <div class="product-details">
        <div class="product-category">{{ $product->category->name }}</div>
        <h1>{{ $product->name }}</h1>

        <div class="product-price-section">
            <span class="price-current">Rs. {{ number_format($product->price, 2) }}</span>
            @if($product->old_price)
                <span class="price-old">Rs. {{ number_format($product->old_price, 2) }}</span>
                <span class="discount-badge">{{ $product->discount_percentage }}% OFF</span>
            @endif
        </div>

        <div class="product-description">
            {{ $product->description }}
        </div>

        @if(!$product->is_sold_out)
        <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="size-selector">
                <h3>Select Size</h3>
                <div class="size-options">
                    @foreach($product->available_sizes as $size)
                        <label class="size-option">
                            <input type="radio" name="size" value="{{ $size }}" style="display: none;" required>
                            {{ $size }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="quantity-selector">
                <h3>Quantity:</h3>
                <div class="quantity-controls">
                    <button type="button" class="qty-btn" onclick="decreaseQty()">−</button>
                    <input type="number" name="quantity" value="1" min="1" max="10" class="qty-input" id="qtyInput" readonly>
                    <button type="button" class="qty-btn" onclick="increaseQty()">+</button>
                </div>
            </div>

            <button type="submit" class="add-to-cart-btn">Add to Cart</button>
        </form>
        @else
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; text-align: center; margin-top: 20px;">
            <strong>This product is currently sold out</strong>
        </div>
        @endif
    </div>
</div>

@if($relatedProducts->count() > 0)
<div class="related-products">
    <h2>You May Also Like</h2>
    <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        @foreach($relatedProducts as $related)
            <div class="product-card" style="background: white; border: 1px solid #eee; overflow: hidden;">
                <div style="position: relative; width: 100%; padding-bottom: 133%; overflow: hidden; background: #f5f5f5;">
                    <img src="{{ asset('storage/' . $related->primary_image) }}" 
                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 15px;">
                    <div style="font-size: 14px; min-height: 40px; margin-bottom: 8px;">{{ $related->name }}</div>
                    <div style="font-size: 18px; font-weight: 700; color: #c2185b; margin-bottom: 12px;">
                        Rs. {{ number_format($related->price, 2) }}
                    </div>
                    <a href="{{ route('product.show', $related->slug) }}" 
                       style="display: block; width: 100%; padding: 10px; background: #000; color: white; text-align: center; text-decoration: none; text-transform: uppercase; font-size: 13px;">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

@push('scripts')
<script>
    // Image gallery
    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        element.classList.add('active');
    }

    // Size selector
    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Quantity controls
    function increaseQty() {
        let input = document.getElementById('qtyInput');
        let value = parseInt(input.value);
        if (value < 10) {
            input.value = value + 1;
        }
    }

    function decreaseQty() {
        let input = document.getElementById('qtyInput');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    }
</script>
@endpush

@endsection