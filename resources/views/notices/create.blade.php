@extends('layouts.app')

@section('title', 'Post Notice - TeamBoard')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-bullhorn"></i> Post New Notice
        </h1>
        <p style="color: #666;">Share an announcement with the team</p>
    </div>

    <div class="card">
        <form action="{{ route('notices.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Notice Title <span style="color: #BC4626;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Priority Level <span style="color: #BC4626;">*</span></label>
                <select name="priority" class="form-select" required>
                    <option value="">Select priority...</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }} selected>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Notice Content <span style="color: #BC4626;">*</span></label>
                <textarea name="content_body" class="form-control" rows="10" required placeholder="Write your notice content here...">{{ old('content_body') }}</textarea>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-accent" style="flex: 1;">
                    <i class="fas fa-paper-plane"></i> Post Notice
                </button>
                <a href="{{ route('notices.index') }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
