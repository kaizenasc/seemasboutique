@extends('layouts.app')

@section('title', 'Collections - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .collections-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .collections-header h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .collections-container {
        max-width: 1400px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .category-card {
        position: relative;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .category-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #c2185b, #880e4f);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: white;
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 40px 25px;
        color: white;
    }

    .category-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .category-count {
        font-size: 16px;
        opacity: 0.95;
        margin-bottom: 15px;
    }

    .view-collection-btn {
        display: inline-block;
        padding: 10px 25px;
        background: white;
        color: #c2185b;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }

    .category-card:hover .view-collection-btn {
        background: #c2185b;
        color: white;
    }

    @media (max-width: 768px) {
        .collections-header h1 {
            font-size: 32px;
        }

        .category-grid {
            grid-template-columns: 1fr;
        }

        .category-card {
            height: 350px;
        }
    }
</style>
@endpush

<div class="collections-header">
    <h1>Our Collections</h1>
    <p>Explore our curated categories of ethnic wear</p>
</div>

<div class="collections-container">
    <div class="category-grid">
        @forelse($categories as $category)
            <a href="{{ route('category.products', $category->slug) }}" class="category-card">
                <div class="category-image">{{ $category->icon ?? '🎊' }}</div>
                <div class="category-overlay">
                    <div class="category-title">{{ $category->name }}</div>
                    <div class="category-count">{{ $category->products_count }} Products Available</div>
                    <span class="view-collection-btn">View Collection →</span>
                </div>
            </a>
        @empty
            <p style="text-align: center; padding: 60px 20px; grid-column: 1/-1; color: #666; font-size: 18px;">
                No collections available yet. Check back soon!
            </p>
        @endforelse
    </div>
</div>

@endsection