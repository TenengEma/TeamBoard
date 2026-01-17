@extends('layouts.app')

@section('title', 'Notice Board - TeamBoard')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;" data-animate="fade-in" class="fade-fast">
    <div data-animate="fade-up">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-bullhorn"></i> Notice Board
        </h1>
        <p style="color: #666;">View and manage all notices</p>
    </div>
    <a href="{{ route('notices.create') }}" class="btn btn-accent">
        <i class="fas fa-plus"></i> Post Notice
    </a>
</div>

<!-- Filter -->
<div class="card" style="margin-bottom: 30px;" data-animate="fade-up">
    <form action="{{ route('notices.index') }}" method="GET">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px;">
            <div>
                <input type="text" name="search" class="form-control" placeholder="Search notices..." value="{{ request('search') }}">
            </div>
            <div>
                <select name="priority" class="form-select">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('notices.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Notices List -->
@if($notices->count() > 0)
<div style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 30px;">
    @foreach($notices as $notice)
    <div class="card hover-raise" data-animate="fade-up">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <h2 style="font-size: 24px; color: #333; margin: 0;">{{ $notice->title }}</h2>
                    <span class="priority-badge priority-{{ $notice->priority }}">{{ $notice->priority }}</span>
                </div>
                <p style="color: #666; font-size: 14px; margin: 0;">
                    <i class="fas fa-user"></i> By {{ $notice->author->name }} • 
                    <i class="fas fa-clock"></i> {{ $notice->created_at->diffForHumans() }}
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('notices.show', $notice) }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View
                </a>
                @if(auth()->id() === $notice->author_id || auth()->user()->isAdmin())
                <a href="{{ route('notices.edit', $notice) }}" class="btn btn-accent">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('notices.destroy', $notice) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notice?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
                @endif
            </div>
        </div>
        <p style="color: #555; line-height: 1.6;">{{ Str::limit($notice->content_body, 200) }}</p>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: center;">
    {{ $notices->links() }}
</div>
@else
<div class="card" style="text-align: center; padding: 60px 20px;" data-animate="fade-up">
    <i class="fas fa-bullhorn" style="font-size: 64px; color: #e0e0e0; margin-bottom: 20px;"></i>
    <h3 style="color: #666; margin-bottom: 10px;">No notices found</h3>
    <p style="color: #999; margin-bottom: 20px;">Be the first to post a notice</p>
    <a href="{{ route('notices.create') }}" class="btn btn-accent">
        <i class="fas fa-plus"></i> Post Notice
    </a>
</div>
@endif
@endsection
