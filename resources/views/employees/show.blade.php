@extends('layouts.app')

@section('title', $employee->name . ' - TeamBoard')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Employees
        </a>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-accent">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; gap: 30px; align-items: start;">
            <div style="flex-shrink: 0;">
                <div style="width: 150px; height: 150px; border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #347486, #DFA44D);">
                    @if($employee->photo_path)
                        <img src="{{ asset('storage/' . $employee->photo_path) }}" alt="{{ $employee->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 72px; color: white; font-weight: 700;">
                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>
            
            <div style="flex: 1;">
                <h1 style="font-size: 32px; color: #333; margin-bottom: 10px;">{{ $employee->name }}</h1>
                <p style="font-size: 18px; color: #666; margin-bottom: 20px;">
                    <i class="fas fa-building"></i> {{ $employee->department }}
                </p>
                
                <div style="display: grid; grid-template-columns: auto 1fr; gap: 15px 20px; margin-bottom: 30px;">
                    <div style="color: #666; font-weight: 500;">
                        <i class="fas fa-envelope"></i> Email:
                    </div>
                    <div>
                        <a href="mailto:{{ $employee->email }}" style="color: #347486; text-decoration: none;">{{ $employee->email }}</a>
                    </div>
                    
                    @if($employee->phone_number)
                    <div style="color: #666; font-weight: 500;">
                        <i class="fas fa-phone"></i> Phone:
                    </div>
                    <div>
                        <a href="tel:{{ $employee->phone_number }}" style="color: #347486; text-decoration: none;">{{ $employee->phone_number }}</a>
                    </div>
                    @endif
                    
                    <div style="color: #666; font-weight: 500;">
                        <i class="fas fa-calendar"></i> Joined:
                    </div>
                    <div>{{ $employee->created_at->format('F d, Y') }}</div>
                </div>
                
                @if($employee->biographical_information)
                <div>
                    <h3 style="font-size: 18px; color: #347486; margin-bottom: 10px;">About</h3>
                    <p style="color: #555; line-height: 1.8;">{{ $employee->biographical_information }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
