@extends('layouts.app')

@section('title', 'Add Event')

@section('content')
    <!-- Add Event Form -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">➕</div>
            <h2 class="section-title">Add New Event</h2>
        </div>

        <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="titre" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-input" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-input" required>
                    <option value="scheduled">Scheduled</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label>Images (Multiple)</label>
                <input type="file" name="images[]" multiple class="form-input">
                <p class="form-hint">You can select multiple images</p>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Event</button>
                <a href="{{ route('evenements.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <style>
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 200, 215, 0.2);
        }
        
        textarea.form-input {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-hint {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 5px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
    </style>
@endsection