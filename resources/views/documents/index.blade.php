@extends('layouts.app')

@section('title', 'Documents - TeamBoard')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;" data-animate="fade-in" class="fade-fast">
    <div data-animate="fade-up">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-folder-open"></i> Document Sharing
        </h1>
        <p style="color: #666;">Upload and access shared documents</p>
    </div>
    <a href="{{ route('documents.create') }}" class="btn btn-primary">
        <i class="fas fa-upload"></i> Upload Document
    </a>
</div>

<!-- Search -->
<div class="card" style="margin-bottom: 30px;" data-animate="fade-up">
    <form action="{{ route('documents.index') }}" method="GET">
        <div style="display: flex; gap: 15px;">
            <input type="text" name="search" class="form-control" placeholder="Search documents..." value="{{ request('search') }}" style="flex: 1;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                <i class="fas fa-redo"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Documents Table -->
@if($documents->count() > 0)
<div class="card" data-animate="fade-up">
    <table class="table">
        <thead>
            <tr>
                <th><i class="fas fa-file"></i> Document</th>
                <th><i class="fas fa-user"></i> Uploaded By</th>
                <th><i class="fas fa-clock"></i> Date</th>
                <th><i class="fas fa-cog"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>
                    <div style="font-weight: 600; color: #333; margin-bottom: 3px;">{{ $document->title }}</div>
                    <div style="font-size: 13px; color: #999;">{{ $document->filename }}</div>
                </td>
                <td>{{ $document->uploader->name }}</td>
                <td>{{ $document->created_at->format('M d, Y') }}</td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('documents.download', $document) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px;">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @if(auth()->id() === $document->uploader_id || auth()->user()->isAdmin())
                        <form action="{{ route('documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: center; margin-top: 20px;">
    {{ $documents->links() }}
</div>
@else
<div class="card" style="text-align: center; padding: 60px 20px;" data-animate="fade-up">
    <i class="fas fa-folder-open" style="font-size: 64px; color: #e0e0e0; margin-bottom: 20px;"></i>
    <h3 style="color: #666; margin-bottom: 10px;">No documents found</h3>
    <p style="color: #999; margin-bottom: 20px;">Upload your first document</p>
    <a href="{{ route('documents.create') }}" class="btn btn-primary">
        <i class="fas fa-upload"></i> Upload Document
    </a>
</div>
@endif
@endsection
