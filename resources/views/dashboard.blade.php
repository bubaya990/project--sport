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
    <a href="#" class="btn btn-primary">Learn More</a>
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
                    <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">View Photos</a>
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
    <div class="section-card">
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
    /* Hero Section Styles */
    .hero-section {
        margin: 0 -20px;
    }
    
    .events-swiper {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    
    .swiper-container {
        width: 100%;
        height: 80vh;
        min-height: 500px;
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
    }
    
    .event-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
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
    }
    
    .hero-description {
        margin: 0 0 24px;
        font-size: 16px;
        max-width: 700px;
        line-height: 1.5;
    }
    
    .event-details {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
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
    }
    
    .past-event-card {
        border-radius: 12px;
        overflow: hidden;
        background: var(--secondary);
        transition: transform 0.3s ease;
    }
    
    .past-event-card:hover {
        transform: translateY(-5px);
    }
    
    .past-event-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .past-event-image.placeholder {
        background: linear-gradient(135deg, var(--secondary-light), var(--secondary));
    }
    
    .past-event-content {
        padding: 16px;
    }
    
    /* Contact Section */
    .contact-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .contact-info {
        display: grid;
        gap: 20px;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
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
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        text-decoration: none;
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
        
        .contact-container {
            grid-template-columns: 1fr;
        }
        
        .swiper-container {
            height: 70vh;
        }
    }
</style>

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    });
</script>
@endsection