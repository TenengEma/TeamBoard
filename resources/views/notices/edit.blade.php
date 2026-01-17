@extends('layouts.app')

@section('title', 'Edit Notice - TeamBoard')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-edit"></i> Edit Notice
        </h1>
        <p style="color: #666;">Update notice information</p>
    </div>

    <div class="card">
        <form action="{{ route('notices.update', $notice) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Notice Title <span style="color: #BC4626;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $notice->title) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Priority Level <span style="color: #BC4626;">*</span></label>
                <select name="priority" class="form-select" required>
                    <option value="low" {{ old('priority', $notice->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $notice->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $notice->priority) == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Notice Content <span style="color: #BC4626;">*</span></label>
                <textarea name="content_body" class="form-control" rows="10" required>{{ old('content_body', $notice->content_body) }}</textarea>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-accent" style="flex: 1;">
                    <i class="fas fa-save"></i> Update Notice
                </button>
                <a href="{{ route('notices.show', $notice) }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
