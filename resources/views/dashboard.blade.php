@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div id="dashboardContent">
    <!-- Hero Section with Full-Width Swiper -->
    <div class="hero-section">
        <div class="events-swiper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @forelse($upcomingEvents as $event)
                    <div class="swiper-slide">
                        <div class="hero-event-card">
                            @if($event->images && count($event->images) > 0)
                            <img src="{{ asset('storage/'.$event->images[0]) }}" alt="{{ $event->titre }}" class="hero-bg-image">
                            @else
                            <div class="hero-bg-image placeholder"></div>
                            @endif
                            <div class="hero-content-overlay">
                                <div class="event-meta">
                                    <span class="event-date">{{ $event->date->format('M d, Y') }}</span>
                                    <span class="event-status {{ $event->status }}">{{ ucfirst($event->status) }}</span>
                                </div>
                                <h1 class="hero-title">{{ $event->titre }}</h1>
                                <p class="hero-description">{{ Str::limit($event->description, 150) }}</p>
                                <div class="event-details">
                                    @if($event->date)
                                    <span class="detail-item">⏰ {{ $event->date->format('h:i A') }}</span>
                                    @endif
                                    @if($event->lieu)
                                    <span class="detail-item">📍 {{ $event->lieu }}</span>
                                    @endif
                                </div>
                                <div class="hero-actions">
                    <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">see detales</a>
                                    @if(auth()->user()->is_admin)
                                    <div class="admin-actions">
                                        <a href="{{ route('evenements.edit', $event->id) }}" class="btn-icon">✏️</a>
                                        <form action="{{ route('evenements.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon">🗑️</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <div class="no-events hero-event-card">
                            <div class="empty-state">
                                <div class="empty-icon">📅</div>
                                <h3>No upcoming events</h3>
                                <p>Check back later for new events</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <!-- Past Experiences Section -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">📅</div>
            <h2 class="section-title">Past Experiences</h2>
        </div>
        
        <div class="past-events-grid">
            @forelse($completedEvents as $event)
            <div class="past-event-card">
                @if($event->images && count($event->images) > 0)
                <img src="{{ asset('storage/'.$event->images[0]) }}" alt="{{ $event->titre }}" class="past-event-image">
                @else
                <div class="past-event-image placeholder"></div>
                @endif
                <div class="past-event-content">
                    <div class="event-date">{{ $event->date->format('M d, Y') }}</div>
                    <h3 class="event-title">{{ $event->titre }}</h3>
                    <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                    <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">see events</a>
                </div>
            </div>
            @empty
            <div class="no-events">
                <div class="empty-state">
                    <div class="empty-icon">🏆</div>
                    <h3>No past experiences</h3>
                    <p>Your completed events will appear here</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Contact & Support Section -->
    <div class="section-card contact-section">
        <div class="section-header">
            <div class="section-icon">📞</div>
            <h2 class="section-title">Contact & Support</h2>
            @if(auth()->user()->is_admin)
            <div class="admin-controls">
                <button class="btn btn-warning btn-small">Edit</button>
            </div>
            @endif
        </div>
        
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div>
                        <h4>Our Location</h4>
                        <p>123 Event Street, Activity City</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <h4>Email Us</h4>
                        <p>support@eventmanager.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <div>
                        <h4>Call Us</h4>
                        <p>(123) 456-7890</p>
                    </div>
                </div>
            </div>
            
            <div class="social-links">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#" class="social-link facebook">f</a>
                    <a href="#" class="social-link twitter">𝕏</a>
                    <a href="#" class="social-link instagram">📷</a>
                    <a href="#" class="social-link youtube">▶️</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base container */
    #dashboardContent {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Hero Section Styles */
    .hero-section {
        margin: 0 -20px;
        margin-top: -20px;
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
    }
    
    .events-swiper {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    
    .swiper-container {
        width: 100%;
        height: 400vh;
        min-height: 350px;
        max-height: 500px;
    }
    
    .hero-event-card {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .hero-bg-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .swiper-slide-active .hero-bg-image {
        transform: scale(1.03);
    }
    
    .hero-bg-image.placeholder {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
    }
    
    .hero-content-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
        color: white;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s ease 0.3s;
    }
    
    .swiper-slide-active .hero-content-overlay {
        transform: translateY(0);
        opacity: 1;
    }
    
    .event-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
        transform: translateY(10px);
        transition: all 0.5s ease 0.4s;
        opacity: 0;
    }
    
    .swiper-slide-active .event-meta {
        transform: translateY(0);
        opacity: 1;
    }
    
    .event-date {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .event-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .event-status.scheduled {
        background: rgba(0, 200, 215, 0.2);
        color: var(--primary);
    }
    
    .event-status.ongoing {
        background: rgba(245, 158, 11, 0.2);
        color: var(--warning);
    }
    
    .event-status.completed {
        background: rgba(16, 185, 129, 0.2);
        color: var(--success);
    }
    
    .hero-title {
        margin: 0 0 16px;
        font-size: 36px;
        font-weight: 700;
        line-height: 1.2;
        transform: translateY(10px);
        transition: all 0.5s ease 0.5s;
        opacity: 0;
    }
    
    .swiper-slide-active .hero-title {
        transform: translateY(0);
        opacity: 1;
    }
    
    .hero-description {
        margin: 0 0 24px;
        font-size: 16px;
        max-width: 700px;
        line-height: 1.5;
        transform: translateY(10px);
        transition: all 0.5s ease 0.6s;
        opacity: 0;
    }
    
    .swiper-slide-active .hero-description {
        transform: translateY(0);
        opacity: 1;
    }
    
    .event-details {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
        transform: translateY(10px);
        transition: all 0.5s ease 0.7s;
        opacity: 0;
    }
    
    .swiper-slide-active .event-details {
        transform: translateY(0);
        opacity: 1;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .hero-actions {
        display: flex;
        gap: 16px;
        transform: translateY(10px);
        transition: all 0.5s ease 0.8s;
        opacity: 0;
    }
    
    .swiper-slide-active .hero-actions {
        transform: translateY(0);
        opacity: 1;
    }
    
    .admin-actions {
        display: flex;
        gap: 8px;
    }
    
    /* Past Events Grid */
    .past-events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        width: 100%;
    }
    
    .past-event-card {
        border-radius: 12px;
        overflow: hidden;
        background: var(--secondary);
        transition: all 0.3s ease;
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.5s ease forwards;
    }
    
    @keyframes fadeInUp {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .past-event-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .past-event-card:nth-child(1) { animation-delay: 0.1s; }
    .past-event-card:nth-child(2) { animation-delay: 0.2s; }
    .past-event-card:nth-child(3) { animation-delay: 0.3s; }
    .past-event-card:nth-child(4) { animation-delay: 0.4s; }
    .past-event-card:nth-child(5) { animation-delay: 0.5s; }
    .past-event-card:nth-child(6) { animation-delay: 0.6s; }
    
    .past-event-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .past-event-card:hover .past-event-image {
        transform: scale(1.05);
    }
    
    .past-event-image.placeholder {
        background: linear-gradient(135deg, var(--secondary-light), var(--secondary));
    }
    
    .past-event-content {
        padding: 16px;
    }
    
    /* Contact Section */
    .contact-section {
        animation: fadeIn 0.5s ease 0.3s forwards;
        opacity: 0;
    }
    
    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }
    
    .contact-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        width: 100%;
    }
    
    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .contact-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--primary);
    }
    
    .social-links h4 {
        margin: 0 0 15px;
        font-size: 16px;
        color: var(--text);
    }
    
    .social-icons {
        display: flex;
        gap: 15px;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        transform: translateY(-3px) scale(1.1);
    }
    
    .facebook { background: #1877f2; }
    .twitter { background: #1da1f2; }
    .instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
    .youtube { background: #ff0000; }
    
    /* Empty States */
    .no-events {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: var(--secondary);
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content-overlay {
            padding: 24px;
        }
        
        .hero-title {
            font-size: 28px;
        }
        
        .swiper-container {
            height: 50vh;
            min-height: 300px;
        }
        
        .contact-info {
            grid-template-columns: 1fr;
        }
        
        .hero-section {
            margin: 0 -15px;
            margin-top: -15px;
        }
    }
</style>

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper with more effects
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 1000,
            parallax: true,
            on: {
                init: function() {
                    const activeSlide = this.slides[this.activeIndex];
                    const overlay = activeSlide.querySelector('.hero-content-overlay');
                    if (overlay) {
                        overlay.style.opacity = '1';
                        overlay.style.transform = 'translateY(0)';
                    }
                },
                slideChangeTransitionStart: function() {
                    const slides = this.slides;
                    for (let i = 0; i < slides.length; i++) {
                        const overlay = slides[i].querySelector('.hero-content-overlay');
                        if (overlay) {
                            overlay.style.opacity = '0';
                            overlay.style.transform = 'translateY(20px)';
                        }
                    }
                },
                slideChangeTransitionEnd: function() {
                    const activeSlide = this.slides[this.activeIndex];
                    const overlay = activeSlide.querySelector('.hero-content-overlay');
                    if (overlay) {
                        overlay.style.opacity = '1';
                        overlay.style.transform = 'translateY(0)';
                    }
                }
            }
        });
        
        // Add hover effect to cards
        const cards = document.querySelectorAll('.past-event-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px) scale(1.02)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
@endsection