@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <!-- Events List -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">🎯</div>
            <h2 class="section-title">Manage Events</h2>
            <a href="{{ route('evenements.create') }}" class="btn btn-add">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Add New Event</span>
            </a>
        </div>

        @if($evenements->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📅</div>
                <h3>No Events Found</h3>
                <p>Get started by creating your first event</p>
                <a href="{{ route('evenements.create') }}" class="btn btn-add">
                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Create Event</span>
                </a>
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
                        
                        <div class="event-actions">
                            <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-edit">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
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
        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-icon {
            width: 18px;
            height: 18px;
            transition: all 0.3s ease;
        }

        /* Add Button */
        .btn-add {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 6px rgba(0, 200, 215, 0.2);
        }

        .btn-add:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 200, 215, 0.3);
        }

        .btn-add:active {
            transform: translateY(0);
        }

        /* Edit Button */
        .btn-edit {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-edit:hover {
            background: rgba(245, 158, 11, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.1);
        }

        .btn-edit:active {
            transform: translateY(0);
        }

        /* Delete Button */
        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.1);
        }

        .btn-delete:active {
            transform: translateY(0);
        }

        /* Button Ripple Effect */
        .btn::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 1%, transparent 1%) center/15000%;
            opacity: 0;
            transition: opacity 0.5s, background-size 0.5s;
        }

        .btn:active::after {
            background-size: 100%;
            opacity: 1;
            transition: 0s;
        }

        /* Rest of your existing styles... */
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

        /* ... (keep all your other existing styles) ... */

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
            
            .section-header .btn-add {
                width: 100%;
                justify-content: center;
            }
            
            .event-actions {
                flex-direction: column;
            }
            
            .btn-edit, .btn-delete {
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
            
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const x = e.clientX - e.target.getBoundingClientRect().left;
                    const y = e.clientY - e.target.getBoundingClientRect().top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            });
        });
    </script>
@endsection