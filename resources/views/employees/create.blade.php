@extends('layouts.app')

@section('title', 'Add Employee - TeamBoard')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-user-plus"></i> Add New Employee
        </h1>
        <p style="color: #666;">Fill in the details to create a new employee profile</p>
    </div>

    <div class="card">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
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
                <label class="form-label">Department <span style="color: #BC4626;">*</span></label>
                <input type="text" name="department" class="form-control" value="{{ old('department') }}" placeholder="e.g., IT, HR, Sales" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="+1234567890">
            </div>
            
            <div class="form-group">
                <label class="form-label">Profile Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small style="color: #666; font-size: 12px;">Max file size: 2MB. Allowed: JPG, PNG</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Biographical Information</label>
                <textarea name="biographical_information" class="form-control" rows="5" placeholder="Brief description about the employee...">{{ old('biographical_information') }}</textarea>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fas fa-save"></i> Create Employee
                </button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
