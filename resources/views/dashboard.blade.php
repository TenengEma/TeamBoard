@extends('layouts.app')

@section('title', 'Dashboard - TeamBoard')

@section('content')
<div style="margin-bottom: 30px;" data-animate="fade-in" class="fade-fast">
    <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
        <i class="fas fa-home"></i> Dashboard
    </h1>
    <p style="color: #666;">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card gradient-card hover-raise" data-animate="fade-up" style="background: linear-gradient(135deg, #347486 0%, #2a5d6b 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Employees</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_employees'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="card gradient-card hover-raise" data-animate="fade-up" style="background: linear-gradient(135deg, #DFA44D 0%, #c89340 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Notices</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_notices'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
    </div>

    <div class="card gradient-card hover-raise" data-animate="fade-up" style="background: linear-gradient(135deg, #BC4626 0%, #a33d21 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Documents</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_documents'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-folder-open"></i>
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
    <div class="card gradient-card hover-raise" data-animate="fade-up" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Users</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_users'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Recent Content -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px;">
    <!-- Recent Notices -->
    <div class="card glass-card" data-animate="fade-up">
        <h2 class="card-header">
            <i class="fas fa-bullhorn"></i> Recent Notices
        </h2>
        
        @if($recent_notices->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($recent_notices as $notice)
            <a href="{{ route('notices.show', $notice) }}" data-animate="fade-in" class="hover-raise" style="text-decoration: none; color: inherit; padding: 15px; border: 1px solid #e0e0e0; border-radius: 8px; transition: all 0.3s ease;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                    <h3 style="font-size: 16px; font-weight: 600; color: #333; margin: 0;">{{ $notice->title }}</h3>
                    <span class="priority-badge priority-{{ $notice->priority }}">{{ $notice->priority }}</span>
                </div>
                <p style="font-size: 14px; color: #666; margin: 0;">
                    By {{ $notice->author->name }} • {{ $notice->created_at->diffForHumans() }}
                </p>
            </a>
            @endforeach
        </div>
        @else
        <p style="color: #999; text-align: center; padding: 30px 0;">
            <i class="fas fa-inbox" style="font-size: 48px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
            No notices yet
        </p>
        @endif
        
        <a href="{{ route('notices.index') }}" class="btn btn-primary btn-shimmer" style="margin-top: 15px; width: 100%;">
            View All Notices <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Recent Documents -->
    <div class="card glass-card" data-animate="fade-up">
        <h2 class="card-header">
            <i class="fas fa-folder-open"></i> Recent Documents
        </h2>
        
        @if($recent_documents->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($recent_documents as $document)
            <div style="padding: 15px; border: 1px solid #e0e0e0; border-radius: 8px;" class="hover-raise" data-animate="fade-in">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                    <h3 style="font-size: 16px; font-weight: 600; color: #333; margin: 0;">
                        <i class="fas fa-file"></i> {{ $document->title }}
                    </h3>
                    <a href="{{ route('documents.download', $document) }}" class="btn btn-primary" style="padding: 5px 15px; font-size: 12px;">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
                <p style="font-size: 14px; color: #666; margin: 0;">
                    By {{ $document->uploader->name }} • {{ $document->created_at->diffForHumans() }}
                </p>
            </div>
            @endforeach
        </div>
        @else
        <p style="color: #999; text-align: center; padding: 30px 0;">
            <i class="fas fa-inbox" style="font-size: 48px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
            No documents yet
        </p>
        @endif
        
        <a href="{{ route('documents.index') }}" class="btn btn-primary btn-shimmer" style="margin-top: 15px; width: 100%;">
            View All Documents <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<!-- Quick Actions -->
<div class="card glass-card" style="margin-top: 30px;" data-animate="fade-up">
    <h2 class="card-header">
        <i class="fas fa-bolt"></i> Quick Actions
    </h2>
    
    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add Employee
        </a>
        <a href="{{ route('notices.create') }}" class="btn btn-accent">
            <i class="fas fa-bullhorn"></i> Post Notice
        </a>
        <a href="{{ route('documents.create') }}" class="btn btn-secondary">
            <i class="fas fa-upload"></i> Upload Document
        </a>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.users.create') }}" class="btn btn-danger">
            <i class="fas fa-user-shield"></i> Create User
        </a>
        @endif
    </div>
</div>
@endsection
