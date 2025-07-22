<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return EmployeeResource::collection($employee);
    }

   /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // DB::transaction(function () use ($request) {
        //     Employee::create($request->validated());
        // });

        // return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        $employee = $request->StoreEmployee();
        // return redirect()->route('employees.index')
        // ->with('success', 'Employee created successfully.');
        return response([
            'employee' => new EmployeeResource($employee),
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee = $request->UpdateEmployee($employee);
        return response([
            'employee' => new EmployeeResource($employee),
        ]);
        // return redirect()->route('employees.index')
        // ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if($employee->remove()){
            return response(['message' => 'employee deleted']);
        }
        return response(['error' => 'employee does not deleted'], 409);

    // return redirect()->route('employees.index')->with('success', 'Employee soft-deleted.');
    }


    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('employees.index')->with('success', 'Employee restored.');
    }

}