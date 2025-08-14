@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h2 class="section-title">Our Events</h2>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('evenements.add') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add New Event
                </a>
            @endif
        </div>

        <div class="events-grid">
            @forelse($evenements as $evenement)
                <div class="event-card">
                    @if($evenement->images && count($evenement->images) > 0)
                        <div class="event-image">
                            <img src="{{ asset('storage/'.$evenement->images[0]) }}" 
                                 alt="{{ $evenement->titre }}"
                                 class="grid-image">
                            <div class="event-date">
                                <span class="date-day">{{ $evenement->date->format('d') }}</span>
                                <span class="date-month">{{ $evenement->date->format('M') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="event-content">
                        <div class="event-status {{ $evenement->status }}">
                            {{ ucfirst($evenement->status) }}
                        </div>
                        
                        <h3 class="event-title">{{ $evenement->titre }}</h3>
                        <p class="event-description">{{ Str::limit($evenement->description, 100) }}</p>
                        
                        <div class="event-details">
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $evenement->date->format('H:i') }}</span>
                            </div>
                            @if($evenement->end_date)
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $evenement->end_date->format('M d, Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="event-actions">
                            <a href="{{ route('evenements.show', $evenement->id) }}" class="btn btn-outline">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>

                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="admin-actions">
                                    <a href="{{ route('evenements.edit', $evenement->id) }}" 
                                       class="btn btn-warning btn-small">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('evenements.destroy', $evenement->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-small">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-events">
                    <div class="empty-state">
                        <i class="fas fa-calendar-times fa-4x"></i>
                        <h3>No Events Found</h3>
                        <p>Check back later for upcoming events</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .event-card {
            background: var(--secondary);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--card-border);
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .event-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-card:hover .event-image img {
            transform: scale(1.1);
        }

        .event-date {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.8);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            color: white;
        }

        .date-day {
            display: block;
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }

        .date-month {
            display: block;
            font-size: 14px;
            text-transform: uppercase;
        }

        .event-content {
            padding: 20px;
        }

        .event-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .event-details {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .detail-item i {
            color: var(--primary);
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

        .event-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            gap: 10px;
        }

        .admin-actions {
            display: flex;
            gap: 8px;
        }

        .event-title {
            font-size: 28px;
            margin: 0 0 20px;
            color: var(--text);
            font-weight: 700;
            line-height: 1.3;
        }

        .event-description {
            font-size: 16px;
            line-height: 1.7;
            color: var(--text);
            margin-bottom: 30px;
            white-space: pre-line;
        }

        .event-actions {
            display: flex;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid var(--card-border);
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .image-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 10px;
            }

            .event-title {
                font-size: 24px;
            }

            .event-actions {
                flex-direction: column;
            }

            .event-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection