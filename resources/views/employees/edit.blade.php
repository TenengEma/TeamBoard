@extends('layouts.app')

@section('title', 'Edit ' . $employee->name . ' - TeamBoard')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-edit"></i> Edit Employee
        </h1>
        <p style="color: #666;">Update {{ $employee->name }}'s information</p>
    </div>

    <div class="card">
        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Full Name <span style="color: #BC4626;">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address <span style="color: #BC4626;">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Department <span style="color: #BC4626;">*</span></label>
                <input type="text" name="department" class="form-control" value="{{ old('department', $employee->department) }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $employee->phone_number) }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Profile Photo</label>
                @if($employee->photo_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $employee->photo_path) }}" alt="{{ $employee->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small style="color: #666; font-size: 12px;">Upload a new photo to replace the current one</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Biographical Information</label>
                <textarea name="biographical_information" class="form-control" rows="5">{{ old('biographical_information', $employee->biographical_information) }}</textarea>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-accent" style="flex: 1;">
                    <i class="fas fa-save"></i> Update Employee
                </button>
                <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
