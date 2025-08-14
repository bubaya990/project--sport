@extends('layouts.app')

@section('title', 'Guest List')

@section('content')
<div class="guests-container">
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">👥</div>
            <h2 class="section-title">Guest List</h2>
        </div>

        <div class="guests-grid">
            @forelse($guests as $guest)
                <div class="guest-card">
                    <div class="guest-avatar">
                        {{ strtoupper(substr($guest->name, 0, 1)) }}
                    </div>
                    <div class="guest-info">
                        <h3 class="guest-name">{{ $guest->name }}</h3>
                        <p class="guest-email">{{ $guest->email }}</p>
                        <p class="guest-joined">Joined {{ $guest->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="no-guests">
                    <div class="empty-state">
                        <div class="empty-icon">🤝</div>
                        <h3>No Guests Yet</h3>
                        <p>When guests register, they'll appear here</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .guests-container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .guests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .guest-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: var(--secondary);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .guest-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .guest-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 600;
    }

    .guest-info {
        flex: 1;
    }

    .guest-name {
        margin: 0;
        font-size: 18px;
        color: var(--text);
    }

    .guest-email {
        margin: 5px 0;
        color: var(--text-light);
        font-size: 14px;
    }

    .guest-joined {
        margin: 5px 0 0;
        font-size: 12px;
        color: var(--text-lighter);
    }

    .no-guests {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        background: var(--secondary);
        border-radius: 12px;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .empty-icon {
        font-size: 48px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .guests-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
