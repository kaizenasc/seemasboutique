@extends('layouts.app')

@section('title', 'Contact Us - Seema\'s Boutique')

@section('content')
@push('styles')
<style>
    .contact-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 80px 20px;
        text-align: center;
    }

    .contact-header h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .contact-container {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .contact-info h2 {
        font-size: 28px;
        margin-bottom: 30px;
        color: #c2185b;
    }

    .info-item {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #c2185b, #880e4f);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .info-content h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #333;
    }

    .info-content p {
        color: #666;
        line-height: 1.6;
    }

    .contact-form {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .contact-form h2 {
        font-size: 28px;
        margin-bottom: 30px;
        color: #c2185b;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #c2185b;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 15px;
        background: #c2185b;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .submit-btn:hover {
        background: #880e4f;
    }

    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        background: #25D366;
        color: white;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: background 0.3s;
    }

    .whatsapp-btn:hover {
        background: #128C7E;
    }

    @media (max-width: 768px) {
        .contact-container {
            grid-template-columns: 1fr;
        }

        .contact-header h1 {
            font-size: 32px;
        }

        .contact-info,
        .contact-form {
            padding: 30px 20px;
        }
    }
</style>
@endpush

<div class="contact-header">
    <h1>Get In Touch</h1>
    <p>We'd love to hear from you!</p>
</div>

<div class="contact-container">
    <div class="contact-info">
        <h2>Contact Information</h2>

        <div class="info-item">
            <div class="info-icon">📍</div>
            <div class="info-content">
                <h3>Visit Our Store</h3>
                <p>
                    Seema's Boutique<br>
                    Shop no 9, Raj-Sarthi building<br>
                    Cannaught garden, Town Centre, CIDCO<br>
                    Chhatrapati Sambhaji Nagar - 431003<br>
                    Maharashtra, India
                </p>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">📞</div>
            <div class="info-content">
                <h3>Call Us</h3>
                <p>+91-7058666655</p>
                <a href="https://wa.me/917058666655" class="whatsapp-btn">
                    💬 Chat on WhatsApp
                </a>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">✉️</div>
            <div class="info-content">
                <h3>Email Us</h3>
                <p>care@seemasboutique.in</p>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">🕐</div>
            <div class="info-content">
                <h3>Working Hours</h3>
                <p>
                    Monday - Saturday: 10:00 AM - 8:00 PM<br>
                    Sunday: 11:00 AM - 7:00 PM
                </p>
            </div>
        </div>
    </div>

    <div class="contact-form">
        <h2>Send Us a Message</h2>
        <form>
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Your Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" placeholder="Write your message here..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</div>

@endsection