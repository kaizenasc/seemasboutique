@extends('layouts.app')

@section('title', 'Seema\'s Boutique - Designer Ethnic Wear')

@section('content')
@push('styles')
<style>
    /* Hero Slider */
    .hero-slider {
        position: relative;
        overflow: hidden;
        height: 600px;
    }

    .hero-slide {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #880e4f, #c2185b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .hero-content {
        text-align: center;
        max-width: 800px;
        padding: 20px;
    }

    .hero-content h1 {
        font-size: 48px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .hero-content p {
        font-size: 20px;
        margin-bottom: 30px;
    }

    .btn-primary {
        background: white;
        color: #c2185b;
        padding: 15px 40px;
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Section Title */
    .section-title {
        text-align: center;
        padding: 60px 20px 40px;
        font-size: 36px;
        font-weight: 700;
        color: #333;
    }

    /* Product Grid */
    .product-grid {

         max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px 60px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 280px));
    gap: 30px;
    justify-content: center;
        
        
        
        
        
        
    }

    .product-card {
        background: white;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        border: 1px solid #eee;
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
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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

    .btn-add-cart {
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

    .btn-add-cart:hover {
        background: #c2185b;
    }

    .btn-add-cart.sold-out {
        background: #999;
        cursor: not-allowed;
    }

    /* Category Section */
    .category-grid {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px 60px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .category-card {
        position: relative;
        height: 350px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s;
        text-decoration: none;
    }

    .category-card:hover {
        transform: scale(1.05);
    }

    .category-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #c2185b, #880e4f);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: white;
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        padding: 30px 20px;
        color: white;
    }

    .category-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .category-count {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Features */
    .features {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        background: white;
    }

    .feature-card {
        text-align: center;
    }

    .feature-icon {
        font-size: 50px;
        color: #c2185b;
        margin-bottom: 20px;
    }

    .feature-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .feature-desc {
        color: #666;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 32px;
        }

        .hero-content p {
            font-size: 16px;
        }

        .hero-slider {
            height: 400px;
        }

        .section-title {
            font-size: 28px;
        }

        .product-grid {
           max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px 60px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 280px));
    gap: 30px;
    justify-content: center;
           
        }

        .category-grid {
            grid-template-columns: 1fr;
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
    }
</style>
@endpush

<!-- Hero Slider -->
<section class="hero-slider">
    <div class="hero-slide">
        <div class="hero-content">
            <h1>Discover Elegance</h1>
            <p>Experience the finest collection of designer ethnic wear</p>
            <a href="{{ route('shop') }}" class="btn-primary">Shop Now</a>
        </div>
    </div>
</section>

<!-- Best Sellers -->
<section id="best-sellers">
    <h2 class="section-title">Best Sellers</h2>
    <div class="product-grid">
        @forelse($bestSellers as $product)
            <div class="product-card">
                @if($product->is_sold_out)
                    <div class="product-badge badge-soldout">Sold Out</div>
                @elseif($product->discount_percentage)
                    <div class="product-badge">-{{ $product->discount_percentage }}%</div>
                @endif
                
                <div class="product-image-wrapper">
                    <img src="{{ asset('uploads/' . $product->primary_image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                
                <div class="product-info">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-price">
                        <span class="current-price">Rs. {{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span class="old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>
                    @if($product->is_sold_out)
                        <button class="btn-add-cart sold-out" disabled>Sold Out</button>
                    @else
                        <a href="{{ route('product.show', $product->slug) }}" class="btn-add-cart">View Details</a>
                    @endif
                </div>
            </div>
        @empty
            <p style="text-align: center; padding: 40px; grid-column: 1/-1;">No products available yet.</p>
        @endforelse
    </div>
</section>

<!-- Shop by Categories -->
<section id="categories">
    <h2 class="section-title">Shop By Latest Category</h2>
    <div class="category-grid">
        @forelse($categories as $category)
            <a href="{{ route('category.products', $category->slug) }}" class="category-card">
                <div class="category-image">{{ $category->icon ?? '🎊' }}</div>
                <div class="category-overlay">
                    <div class="category-title">{{ $category->name }}</div>
                    <div class="category-count">{{ $category->products_count }} items</div>
                </div>
            </a>
        @empty
            <p style="text-align: center; padding: 40px; grid-column: 1/-1;">No categories available yet.</p>
        @endforelse
    </div>
</section>

<!-- New Arrivals -->
@if($newArrivals->count() > 0)
<section id="new-arrivals">
    <h2 class="section-title">New Arrivals</h2>
    <div class="product-grid">
        @foreach($newArrivals as $product)
            <div class="product-card">
                @if($product->discount_percentage)
                    <div class="product-badge">-{{ $product->discount_percentage }}%</div>
                @endif
                
                <div class="product-image-wrapper">
                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                
                <div class="product-info">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-price">
                        <span class="current-price">Rs. {{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <span class="old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('product.show', $product->slug) }}" class="btn-add-cart">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Features -->
<section class="features">
    <div class="feature-card">
        <div class="feature-icon">🚚</div>
        <div class="feature-title">Free Shipping</div>
        <div class="feature-desc">Enjoy delivery at no extra cost.</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">✅</div>
        <div class="feature-title">Safe Check Out</div>
        <div class="feature-desc">Shop with complete confidence.</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">🔄</div>
        <div class="feature-title">Easy Return & Exchange</div>
        <div class="feature-desc">7-Day Easy Return & Exchange Available</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">💬</div>
        <div class="feature-title">24/7 Support</div>
        <div class="feature-desc">Assistance available anytime you need.</div>
    </div>
</section>

@endsection