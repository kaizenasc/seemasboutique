@extends('layouts.app')

@section('title', 'Shop - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .shop-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .shop-header h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .shop-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .shop-filters {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .filter-btn {
        padding: 10px 20px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.3s;
        text-decoration: none;
        color: #333;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #c2185b;
        color: white;
        border-color: #c2185b;
    }

    .product-grid {
        display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 280px));
    gap: 30px;
    margin-bottom: 40px;
    justify-content: center;
       
       
       
       
    }

    .product-card {
        background: white;
        border: 1px solid #eee;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #c2185b;
        color: white;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        z-index: 1;
    }

    .badge-soldout {
        background: #666;
    }

    .product-image-wrapper {
         position: relative;
         width: 100%;
        padding-bottom: 133%;
        overflow: hidden;
        background: #f5f5f5;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-info {
        padding: 15px;
    }

    .product-title {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 8px;
        color: #333;
        min-height: 40px;
        line-height: 1.4;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .current-price {
        font-size: 18px;
        font-weight: 700;
        color: #c2185b;
    }

    .old-price {
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
    }

    .btn-view {
        width: 100%;
        padding: 10px;
        background: #000;
        color: white;
        border: none;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-view:hover {
        background: #c2185b;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 5px;
    }

    .pagination a:hover {
        background: #c2185b;
        color: white;
        border-color: #c2185b;
    }

    .pagination .active {
        background: #c2185b;
        color: white;
        border-color: #c2185b;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .shop-header h1 {
            font-size: 28px;
        }
    }
</style>
@endpush

<div class="shop-header">
    <h1>Shop All Products</h1>
    <p>Discover our complete collection</p>
</div>

<div class="shop-container">
    <div class="shop-filters">
        <div class="filter-group">
            <a href="{{ route('shop') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $cat)
                <a href="{{ route('shop', ['category' => $cat->slug]) }}" 
                   class="filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                @if($product->is_sold_out)
                    <div class="product-badge badge-soldout">Sold Out</div>
                @elseif($product->discount_percentage)
                    <div class="product-badge">-{{ $product->discount_percentage }}%</div>
                @endif
                
                <div class="product-image-wrapper">
                    <img src="{{ productImage($product->primary_image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                
                <div class="product-info">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-price">
                        <span class="current-price">Rs. {{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span class="old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('product.show', $product->slug) }}" class="btn-view">View Details</a>
                </div>
            </div>
        @empty
            <p style="text-align: center; padding: 60px 20px; grid-column: 1/-1; color: #666;">
                No products found. Check back soon!
            </p>
        @endforelse
    </div>

    {{ $products->links() }}
</div>

@endsection