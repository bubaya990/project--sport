@extends('layouts.app')

@section('title', $evenement->titre)

@section('content')
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-images"></i>
            </div>
            <h2 class="section-title">Event Gallery</h2>
            <a href="{{ route('evenements.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i> Back to Events
            </a>
        </div>

        <div class="event-gallery-container">
            <!-- Image Grid Gallery -->
            @if($evenement->images && count($evenement->images) > 0)
                <div class="image-grid">
                    @foreach($evenement->images as $key => $image)
                        <div class="grid-item">
                            <img src="{{ asset('storage/'.$image) }}" 
                                 alt="Event image {{ $key + 1 }}"
                                 class="grid-image">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-images">
                    <i class="fas fa-image fa-4x"></i>
                    <p>No images available for this event</p>
                </div>
            @endif

            <!-- Event Details -->
            <div class="event-details">
                <div class="event-meta">
                    <span class="event-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ $evenement->date->format('M d, Y') }}
                        @if($evenement->end_date)
                            <span class="date-separator">-</span>
                            {{ $evenement->end_date->format('M d, Y') }}
                        @endif
                    </span>
                    <span class="event-status status-{{ $evenement->status }}">
                        {{ ucfirst($evenement->status) }}
                    </span>
                </div>

                <h1 class="event-title">{{ $evenement->titre }}</h1>

                <div class="event-description">
                    {!! nl2br(e($evenement->description)) !!}
                </div>

                @if(Auth::check() && Auth::user()->isAdmin())
                <div class="event-actions">
                    <a href="{{ route('evenements.edit', $evenement->id) }}" 
                       class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('evenements.destroy', $evenement->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .event-gallery-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            width: 100%;
        }

        .grid-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 4/3;
            transition: transform 0.3s ease;
            background: var(--secondary-light);
        }

        .grid-item:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 200, 215, 0.2);
        }

        .grid-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .grid-item:hover .grid-image {
            transform: scale(1.05);
        }

        .no-images {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: var(--secondary-light);
            border-radius: 8px;
            color: var(--text-secondary);
        }

        .no-images i {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .event-details {
            padding: 20px 0;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .event-date {
            font-size: 14px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-date i {
            font-size: 16px;
        }

        .date-separator {
            margin: 0 5px;
        }

        .event-status {
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 20px;
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