<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Traits\FilterBySearch;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use FilterBySearch;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::withTrashed();

        $filters = [
            'name' => 'like',
            'status' => 'exact',
            'hired_at' => 'date',
        ];

        $employees = $this->applyFilters($employees, $request, $filters);

        $employees = $employees->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }
   /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = $request->StoreEmployee();

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $employee = Employee::findOrFail($id);
    return view('employees.edit', compact('employee'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee = $request->UpdateEmployee($employee);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee soft deleted']);
    }


    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        return response()->json(['message' => 'Employee restored']);
    }


}