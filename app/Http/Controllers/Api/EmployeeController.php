<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('department')) {
            $query->where('department', $request->department);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        return response()->json(
            $query->paginate($request->per_page ?? 15)
        );
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'department' => 'required|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'biographical_information' => 'nullable|string',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:employees,email,' . $employee->id,
            'department' => 'string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'biographical_information' => 'nullable|string',
        ]);

        $employee->update($validated);

        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }

    public function search($query)
    {
        return response()->json(
            Employee::where('name', 'like', "%{$query}%")
                     ->orWhere('email', 'like', "%{$query}%")
                     ->orWhere('department', 'like', "%{$query}%")
                     ->limit(10)
                     ->get()
        );
    }
}
