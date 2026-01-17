@extends('layouts.app')

@section('title', 'Edit User - TeamBoard')

@section('content')
<div style="max-width: 700px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-edit"></i> Edit User
        </h1>
        <p style="color: #666;">Update {{ $user->name }}'s information</p>
    </div>

    <div class="card">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Full Name <span style="color: #BC4626;">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address <span style="color: #BC4626;">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Role <span style="color: #BC4626;">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
                <small style="color: #666; font-size: 12px;">Minimum 6 characters</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-accent" style="flex: 1;">
                    <i class="fas fa-save"></i> Update User
                </button>
                <a href="{{ route('admin.users') }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
