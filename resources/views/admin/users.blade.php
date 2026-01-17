@extends('layouts.app')

@section('title', 'User Management - TeamBoard')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-users-cog"></i> User Management
        </h1>
        <p style="color: #666;">Manage all system users</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add User
        </a>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<!-- Users Table -->
@if($users->count() > 0)
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th><i class="fas fa-user"></i> Name</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-shield-alt"></i> Role</th>
                <th><i class="fas fa-clock"></i> Joined</th>
                <th><i class="fas fa-cog"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div style="font-weight: 600; color: #333;">{{ $user->name }}</div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="priority-badge" style="background-color: {{ $user->role === 'admin' ? '#BC4626' : '#347486' }};">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-accent" style="padding: 6px 12px; font-size: 13px;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @if(auth()->id() !== $user->id)
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
    {{ $users->links() }}
</div>
@else
<div class="card" style="text-align: center; padding: 60px 20px;">
    <i class="fas fa-users" style="font-size: 64px; color: #e0e0e0; margin-bottom: 20px;"></i>
    <h3 style="color: #666; margin-bottom: 10px;">No users found</h3>
    <p style="color: #999; margin-bottom: 20px;">Create your first user</p>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add User
    </a>
</div>
@endif
@endsection
