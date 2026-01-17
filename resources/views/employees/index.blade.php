@extends('layouts.app')

@section('title', 'Employees - TeamBoard')

@section('content')
<div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;" data-animate="fade-in" class="fade-fast">
    <div data-animate="fade-up">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-users"></i> Employee Directory
        </h1>
        <p style="color: #666;">Manage and view all employees</p>
    </div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Employee
    </a>
</div>

<!-- Search and Filter -->
<div class="card" style="margin-bottom: 30px;" data-animate="fade-up">
    <form action="{{ route('employees.index') }}" method="GET">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px;">
            <div>
                <input type="text" name="search" class="form-control" placeholder="Search by name, email, or department..." value="{{ request('search') }}">
            </div>
            <div>
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Employee Grid -->
@if($employees->count() > 0)
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px;">
    @foreach($employees as $employee)
    <div class="card hover-raise" data-animate="fade-up" style="text-align: center;">
        <div style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 15px; overflow: hidden; background: linear-gradient(135deg, #347486, #DFA44D);">
            @if($employee->photo_path)
                <img src="{{ asset('storage/' . $employee->photo_path) }}" alt="{{ $employee->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: white; font-weight: 700;">
                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                </div>
            @endif
        </div>
        
        <h3 style="font-size: 18px; margin-bottom: 5px; color: #333;">{{ $employee->name }}</h3>
        <p style="color: #666; font-size: 14px; margin-bottom: 10px;">{{ $employee->department }}</p>
        <p style="color: #999; font-size: 13px; margin-bottom: 15px;">
            <i class="fas fa-envelope"></i> {{ $employee->email }}
        </p>
        
        <div style="display: flex; gap: 10px; justify-content: center;">
            <a href="{{ route('employees.show', $employee) }}" class="btn btn-primary" style="flex: 1;">
                <i class="fas fa-eye"></i> View
            </a>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-accent" style="flex: 1;">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: center;">
    {{ $employees->links() }}
</div>
@else
<div class="card" style="text-align: center; padding: 60px 20px;" data-animate="fade-up">
    <i class="fas fa-users" style="font-size: 64px; color: #e0e0e0; margin-bottom: 20px;"></i>
    <h3 style="color: #666; margin-bottom: 10px;">No employees found</h3>
    <p style="color: #999; margin-bottom: 20px;">Start by adding your first employee</p>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Employee
    </a>
</div>
@endif
@endsection
