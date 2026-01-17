@extends('layouts.app')

@section('title', 'About Us - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .about-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    .about-header h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .about-container {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .about-section {
        background: white;
        border-radius: 15px;
        padding: 50px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        margin-bottom: 40px;
    }

    .about-section h2 {
        font-size: 32px;
        margin-bottom: 25px;
        color: #c2185b;
    }

    .about-section p {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 20px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .feature-box {
        text-align: center;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 50px;
        margin-bottom: 20px;
    }

    .feature-box h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .feature-box p {
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 768px) {
        .about-header h1 {
            font-size: 32px;
        }

        .about-section {
            padding: 30px 20px;
        }

        .about-section h2 {
            font-size: 24px;
        }
    }
</style>
@endpush

<div class="about-header">
    <h1>About Seema's Boutique</h1>
    <p>Where Tradition Meets Contemporary Elegance</p>
</div>

<div class="about-container">
    <div class="about-section">
        <h2>Our Story</h2>
        <p>
            At Seema's Boutique, we believe fashion is more than just clothing—it's a celebration of tradition, reimagined for the modern woman. Founded with a passion for ethnic wear and a vision to blend timeless craftsmanship with contemporary elegance, we have become a trusted name in designer ethnic fashion.
        </p>
        <p>
            Every piece in our collection is carefully curated to reflect the rich heritage of Indian textiles while embracing modern sensibilities. From festive celebrations to everyday elegance, we offer a diverse range of ethnic wear that empowers women to express their unique style with confidence.
        </p>
        <p>
            Our commitment goes beyond fashion—we prioritize quality, comfort, and authenticity in every stitch. Whether it's a handcrafted kurta set, an intricately embroidered suit, or a contemporary co-ord ensemble, each garment is designed to make you feel special.
        </p>
    </div>

    <div class="about-section">
        <h2>Why Choose Us</h2>
        <div class="features-grid">
            <div class="feature-box">
                <div class="feature-icon">✨</div>
                <h3>Premium Quality</h3>
                <p>Handpicked fabrics and meticulous craftsmanship in every piece</p>
            </div>

            <div class="feature-box">
                <div class="feature-icon">🎨</div>
                <h3>Unique Designs</h3>
                <p>Exclusive collections that blend tradition with modern trends</p>
            </div>

            <div class="feature-box">
                <div class="feature-icon">💝</div>
                <h3>Customer First</h3>
                <p>Dedicated support and personalized shopping experience</p>
            </div>

            <div class="feature-box">
                <div class="feature-icon">🚚</div>
                <h3>Fast Delivery</h3>
                <p>Quick and reliable shipping across India</p>
            </div>
        </div>
    </div>

    <div class="about-section">
        <h2>Visit Our Store</h2>
        <p style="font-size: 18px; line-height: 1.8;">
            <strong>Seema's Boutique</strong><br>
            Shop no 9, Raj-Sarthi building<br>
            Cannaught garden, Town Centre, CIDCO<br>
            Chhatrapati Sambhaji Nagar - 431003<br>
            Maharashtra, India
        </p>
        <p style="font-size: 18px; margin-top: 20px;">
            📞 <strong>Phone:</strong> +91-7058666655<br>
            ✉️ <strong>Email:</strong> care@seemasboutique.in
        </p>
    </div>
</div>

@endsection 