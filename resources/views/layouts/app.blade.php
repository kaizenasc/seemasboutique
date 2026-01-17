<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seema\'s Boutique - Designer Ethnic Wear')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Top Banner */
        .top-banner {
            background: #f39c12;
            color: #000;
            padding: 12px 20px;
            font-size: 13px;
            text-align: center;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .banner-text {
            flex: 1;
            text-align: center;
        }

        .banner-close {
            position: absolute;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #000;
            padding: 0;
            line-height: 1;
        }

        /* Desktop Header */
        .desktop-header {
            display: none;
        }

        .header-top {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .header-top-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
           
        }

        .search-icon {
            font-size: 20px;
            color: #666;
            cursor: pointer;
        }

        .search-icon svg {
            width: 20px;
            height: 20px;
        }

        .search-input {
            border: none;
            outline: none;
            font-size: 14px;
            color: #666;
            width: 200px;
        }

        .logo {
            padding-right: 150px;
            text-align: center;
        }

        .logo-text {
            font-size: 36px;
            font-weight: 700;
            color: #c2185b;
            font-family: 'Georgia', serif;
            letter-spacing: 2px;
            text-decoration: none;
        }

        .header-icons {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #333;
            transition: color 0.3s;
            padding: 0;
            position: relative;
        }

        .icon-btn svg {
            width: 22px;
            height: 22px;
        }

        .icon-btn:hover {
            color: #c2185b;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #c2185b;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Navigation */
        .main-nav {
            background: #000;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
        }

        nav {
            display: flex;
            gap: 0;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: 400;
            transition: background 0.3s;
            font-size: 14px;
            padding: 15px 25px;
            display: block;
        }

        nav a:hover {
            background: #c2185b;
        }

        /* Mobile Header */
        .mobile-header {
            display: block;
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .mobile-header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-header-left {
            display: flex;
            align-items: center;
        }

        .mobile-menu-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-btn svg {
            width: 24px;
            height: 24px;
            stroke: #333;
        }

        .mobile-logo {
            flex: 1;
            text-align: center;
        }

        .mobile-logo .logo-text {
            font-size: 24px;
        }

        .mobile-header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Mobile Navigation Overlay */
        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mobile-nav-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Mobile Navigation Menu */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            background: white;
            z-index: 2000;
            transition: left 0.3s;
            overflow-y: auto;
        }

        .mobile-nav.active {
            left: 0;
        }

        .mobile-nav-header {
            padding: 20px;
            background: linear-gradient(135deg, #c2185b, #880e4f);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-nav-title {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Georgia', serif;
        }

        .close-nav-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            color: white;
        }

        .close-nav-btn svg {
            width: 24px;
            height: 24px;
        }

        .mobile-nav-links {
            list-style: none;
        }

        .mobile-nav-links li {
            border-bottom: 1px solid #eee;
        }

        .mobile-nav-links a {
            display: block;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            font-size: 15px;
            transition: background 0.3s;
        }

        .mobile-nav-links a:hover {
            background: #f5f5f5;
            color: #c2185b;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 20px 20px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            color: #c2185b;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            font-size: 14px;
            line-height: 1.8;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: #c2185b;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: #c2185b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .social-icon:hover {
            background: #880e4f;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #333;
            color: #999;
            font-size: 14px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            margin: 20px auto;
            max-width: 1400px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive */
        @media (min-width: 769px) {
            .mobile-header {
                display: none;
            }

            .desktop-header {
                display: block;
            }

            .mobile-nav-overlay,
            .mobile-nav {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .desktop-header {
                display: none;
            }

            .mobile-header {
                display: block;
            }

            .main-nav {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top Banner -->
    <div class="top-banner" id="topBanner">
        <div class="banner-text">FREE SHIPPING ON ORDERS ABOVE 2000</div>
        <button class="banner-close" onclick="document.getElementById('topBanner').style.display='none'">×</button>
    </div>

    <!-- Desktop Header -->
    <header class="desktop-header">
        <div class="header-top">
            <div class="header-top-container">
                <div class="search-box">
                    <form action="{{ route('shop') }}" method="GET" style="display: flex; align-items: center; gap: 10px;">
                        <span class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" name="search" class="search-input" placeholder="Search Products">
                    </form>
                </div>
                <div class="logo">
                    
                    <a href="{{ route('home') }}" class="logo-text" style="text-decoration: none; color: #c2185b;">
                    <img src="{{ asset('images/favicon.png') }}" alt="Seema's Boutique Logo" style="max-width: 150px; height: auto;"></a>
                </div>
                <div class="header-icons">
                    <a href="{{ route('cart') }}" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="cart-count">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="main-nav">
            <div class="nav-container">
                <nav>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('shop') }}">Shop</a>
                    <a href="{{ route('collections') }}">Collections</a>
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Mobile Header -->
    <header class="mobile-header">
        <div class="mobile-header-container">
            <div class="mobile-header-left">
                <button class="mobile-menu-btn" id="menuBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="mobile-logo">
                <a href="{{ route('home') }}" class="logo-text" 
                style="text-decoration: none; color: #c2185b;">

                <img src="{{ asset('images/favicon.png') }}" alt="Seema's Boutique Logo" style="max-width: 120px; height: auto;">
                </a>

            </div>
            <div class="mobile-header-right">
                <a href="{{ route('cart') }}" class="icon-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="cart-count">{{ count(session('cart')) }}</span>
                    @endif
                </a>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" id="navOverlay"></div>

    <!-- Mobile Navigation Menu -->
    <nav class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <div class="mobile-nav-title">Menu</div>
            <button class="close-nav-btn" id="closeNavBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <ul class="mobile-nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('collections') }}">Collections</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('order.track') }}">Track Order</a></li>
        </ul>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>At Seema's Boutique, we believe fashion is more than just clothing—it's a celebration of tradition, reimagined for the modern woman.</p>
                <div class="social-links">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">📷</a>
                    <a href="#" class="social-icon">🐦</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('shop') }}">Shop All</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('size.chart') }}">Size Chart</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Company Policies</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('refund.policy') }}">Refund Policy</a></li>
                    <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Connect With Us</h3>
                <p>Seemas Boutique<br>
                Shop no 9, Raj-Sarthi building<br>
                Cannaught garden, Town Centre, CIDCO<br>
                Chhatrapati Sambhaji Nagar - 431003</p>
                <p>📞 +91-7058666655<br>
                ✉️ care@seemasboutique.in</p>
            </div>
        </div>

        <div class="footer-bottom">
            © 2025 Seema's Boutique | All Rights Reserved
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const menuBtn = document.getElementById('menuBtn');
        const closeNavBtn = document.getElementById('closeNavBtn');
        const mobileNav = document.getElementById('mobileNav');
        const navOverlay = document.getElementById('navOverlay');

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                mobileNav.classList.add('active');
                navOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        const closeMenu = () => {
            mobileNav.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        if (closeNavBtn) {
            closeNavBtn.addEventListener('click', closeMenu);
        }

        if (navOverlay) {
            navOverlay.addEventListener('click', closeMenu);
        }

        const navLinks = document.querySelectorAll('.mobile-nav-links a');
        navLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    </script>
    @stack('scripts')
</body>
</html>