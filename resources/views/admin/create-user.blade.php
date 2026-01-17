@extends('layouts.app')

@section('title', 'Create User - TeamBoard')

@section('content')
<div style="max-width: 700px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-user-plus"></i> Create New User
        </h1>
        <p style="color: #666;">Add a new user to the system</p>
    </div>

    <div class="card">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name <span style="color: #BC4626;">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address <span style="color: #BC4626;">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Role <span style="color: #BC4626;">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password <span style="color: #BC4626;">*</span></label>
                <input type="password" name="password" class="form-control" required>
                <small style="color: #666; font-size: 12px;">Minimum 6 characters</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirm Password <span style="color: #BC4626;">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fas fa-save"></i> Create User
                </button>
                <a href="{{ route('admin.users') }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
