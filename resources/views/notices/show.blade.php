@extends('layouts.app')

@section('title', $notice->title . ' - TeamBoard')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('notices.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Notices
        </a>
        @if(auth()->id() === $notice->author_id || auth()->user()->isAdmin())
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('notices.edit', $notice) }}" class="btn btn-accent">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('notices.destroy', $notice) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
        @endif
    </div>

    <div class="card">
        <div style="margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                <h1 style="font-size: 32px; color: #333; margin: 0;">{{ $notice->title }}</h1>
                <span class="priority-badge priority-{{ $notice->priority }}">{{ $notice->priority }}</span>
            </div>
            
            <div style="display: flex; align-items: center; gap: 20px; color: #666; font-size: 14px;">
                <div>
                    <i class="fas fa-user"></i> By <strong>{{ $notice->author->name }}</strong>
                </div>
                <div>
                    <i class="fas fa-clock"></i> {{ $notice->created_at->format('F d, Y \a\t g:i A') }}
                </div>
                @if($notice->created_at != $notice->updated_at)
                <div>
                    <i class="fas fa-edit"></i> Updated {{ $notice->updated_at->diffForHumans() }}
                </div>
                @endif
            </div>
        </div>
        
        <div style="border-top: 1px solid #e0e0e0; padding-top: 20px;">
            <div style="color: #555; line-height: 1.8; font-size: 16px; white-space: pre-wrap;">{{ $notice->content_body }}</div>
        </div>
    </div>
</div>
@endsection
