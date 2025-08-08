@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <!-- Events List -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">🎯</div>
            <h2 class="section-title">Manage Events</h2>
        </div>
        
        <a href="{{ route('evenements.create') }}" class="btn btn-success" style="margin-bottom: 20px;">
            Add New Event
        </a>

        <div class="events-grid">
            @foreach($evenements as $evenement)
            <div class="event-card">
                @if($evenement->images && count($evenement->images) > 0)
                <div class="event-image-container">
                    <img src="{{ asset('storage/'.$evenement->images[0]) }}" class="event-image">
                </div>
                @else
                <div class="event-image-placeholder">
                    No Image Available
                </div>
                @endif
                
                <div class="event-details">
                    <div class="event-meta">
                        <div class="event-date">
                            {{ $evenement->date->format('M d, Y') }}
                            @if($evenement->end_date)
                                - {{ $evenement->end_date->format('M d, Y') }}
                            @endif
                        </div>
                        <div class="event-status status-{{ $evenement->status }}">
                            {{ ucfirst($evenement->status) }}
                        </div>
                    </div>
                    
                    <div class="event-title">{{ $evenement->titre }}</div>
                    <div class="event-desc">{{ Str::limit($evenement->description, 100) }}</div>
                    
                    <div class="event-actions">
                        <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning btn-small">Edit</a>
                        <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($evenements->isEmpty())
            <div class="empty-state">
                <p style="margin-bottom: 15px;">No events found</p>
                <a href="{{ route('evenements.create') }}" class="btn btn-primary">Create Your First Event</a>
            </div>
        @endif
    </div>

    <style>
        .event-image:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        // Add hover effects to event images
        document.querySelectorAll('.event-image').forEach(img => {
            img.addEventListener('mouseover', () => {
                img.style.transform = 'scale(1.05)';
            });
            img.addEventListener('mouseout', () => {
                img.style.transform = 'scale(1)';
            });
        });
    </script>
@endsection