@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <!-- Events List -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">🎯</div>
            <h2 class="section-title">Manage Events</h2>
            @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('evenements.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Event
                </a>
            @endif
        </div>

        @if($evenements->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📅</div>
                <h3>No Events Found</h3>
                <p>Get started by creating your first event</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('evenements.create') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i> Create Event
                    </a>
                @endif
            </div>
        @else
            <div class="events-grid">
                @foreach($evenements as $evenement)
                <div class="event-card" data-status="{{ $evenement->status }}">
                    @if($evenement->images && count($evenement->images) > 0)
                    <div class="event-image-container">
                        <img src="{{ asset('storage/'.$evenement->images[0]) }}" class="event-image" alt="{{ $evenement->titre }}">
                        <div class="event-image-overlay"></div>
                    </div>
                    @else
                    <div class="event-image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>No Image Available</span>
                    </div>
                    @endif
                    
                    <div class="event-details">
                        <div class="event-meta">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                {{ $evenement->date->format('M d, Y') }}
                                @if($evenement->end_date)
                                    <span class="date-separator">-</span>
                                    {{ $evenement->end_date->format('M d, Y') }}
                                @endif
                            </div>
                            <div class="event-status status-{{ $evenement->status }}">
                                {{ ucfirst($evenement->status) }}
                            </div>
                        </div>
                        
                        <h3 class="event-title">{{ $evenement->titre }}</h3>
                        <p class="event-desc">{{ Str::limit($evenement->description, 100) }}</p>
                        
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <div class="event-actions">
                                <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning btn-small">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-small">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($evenements->hasPages())
            <div class="pagination-wrapper">
                {{ $evenements->links() }}
            </div>
            @endif
        @endif
    </div>

    <style>
        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .event-card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--card-border);
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 200, 215, 0.2);
            border-color: var(--primary);
        }

        .event-card[data-status="ongoing"] {
            border-left: 4px solid var(--warning);
        }

        .event-card[data-status="completed"] {
            border-left: 4px solid var(--success);
        }

        .event-card[data-status="scheduled"] {
            border-left: 4px solid var(--primary);
        }

        .event-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .event-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-image-placeholder {
            width: 100%;
            height: 200px;
            background: var(--secondary-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }

        .event-image-placeholder i {
            font-size: 40px;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        .event-details {
            padding: 16px;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .event-date {
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-date i {
            font-size: 14px;
        }

        .date-separator {
            margin: 0 5px;
        }

        .event-status {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
        }

        .status-scheduled {
            background: rgba(0, 200, 215, 0.2);
            color: var(--primary);
        }

        .status-ongoing {
            background: rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .event-title {
            font-size: 16px;
            margin: 0 0 8px;
            color: var(--text);
            font-weight: 600;
            line-height: 1.4;
        }

        .event-desc {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        .event-actions .btn {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: var(--text);
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            padding: 8px 12px;
            border-radius: 6px;
            background: var(--secondary-light);
            color: var(--text);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
        }

        .page-link:hover {
            background: var(--primary);
            color: white;
        }

        .page-item.active .page-link {
            background: var(--primary);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .section-header .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced hover effects
            const eventCards = document.querySelectorAll('.event-card');
          
            
            eventCards.forEach(card => {
                const img = card.querySelector('.event-image');
                const overlay = card.querySelector('.event-image-overlay');
                
                card.addEventListener('mouseenter', function() {
                    if (img) img.style.transform = 'scale(1.05)';
                    if (overlay) overlay.style.opacity = '1';
                    this.style.boxShadow = '0 10px 25px rgba(0, 200, 215, 0.2)';
                });
                
                card.addEventListener('mouseleave', function() {
                    if (img) img.style.transform = 'scale(1)';
                    if (overlay) overlay.style.opacity = '0';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
@endsection