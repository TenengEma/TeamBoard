@extends('layouts.app')

@section('title', 'Admin Panel - TeamBoard')

@section('content')
<div style="margin-bottom: 30px;">
    <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
        <i class="fas fa-cog"></i> Admin Panel
    </h1>
    <p style="color: #666;">Manage system settings and users</p>
</div>

<!-- Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="background: linear-gradient(135deg, #347486 0%, #2a5d6b 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Users</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_users'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #DFA44D 0%, #c89340 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Admin Users</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['admin_users'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #BC4626 0%, #a33d21 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Regular Users</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['regular_users'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Employees</div>
                <div style="font-size: 32px; font-weight: 700;">{{ $stats['total_employees'] }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-id-card"></i>
            </div>
        </div>
    </div>
</div>

<!-- Management Sections -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px;">
    <!-- User Management -->
    <div class="card">
        <h2 class="card-header">
            <i class="fas fa-users-cog"></i> User Management
        </h2>
        
        <p style="color: #666; margin-bottom: 20px;">Manage system users and their roles</p>
        
        <a href="{{ route('admin.users') }}" class="btn btn-primary" style="width: 100%; margin-bottom: 10px;">
            <i class="fas fa-list"></i> View All Users
        </a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-accent" style="width: 100%;">
            <i class="fas fa-user-plus"></i> Create New User
        </a>
    </div>

    <!-- Recent Users -->
    <div class="card">
        <h2 class="card-header">
            <i class="fas fa-clock"></i> Recent Users
        </h2>
        
        @if($recent_users->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($recent_users as $user)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #e0e0e0; border-radius: 8px;">
                <div>
                    <div style="font-weight: 600; color: #333;">{{ $user->name }}</div>
                    <div style="font-size: 13px; color: #666;">{{ $user->email }}</div>
                </div>
                <span class="priority-badge" style="background-color: {{ $user->role === 'admin' ? '#BC4626' : '#347486' }};">
                    {{ $user->role }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p style="color: #999; text-align: center; padding: 30px 0;">No users yet</p>
        @endif
    </div>

    <!-- System Info -->
    <div class="card">
        <h2 class="card-header">
            <i class="fas fa-info-circle"></i> System Information
        </h2>
        
        <div style="display: grid; gap: 15px;">
            <div style="display: flex; justify-content: space-between; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                <span style="color: #666;">Total Notices</span>
                <strong>{{ $stats['total_notices'] }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                <span style="color: #666;">Total Documents</span>
                <strong>{{ $stats['total_documents'] }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                <span style="color: #666;">Total Employees</span>
                <strong>{{ $stats['total_employees'] }}</strong>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card" style="margin-top: 30px;">
    <h2 class="card-header">
        <i class="fas fa-bolt"></i> Quick Actions
    </h2>
    
    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add User
        </a>
        <a href="{{ route('employees.create') }}" class="btn btn-accent">
            <i class="fas fa-id-card"></i> Add Employee
        </a>
        <a href="{{ route('notices.create') }}" class="btn btn-secondary">
            <i class="fas fa-bullhorn"></i> Post Notice
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
