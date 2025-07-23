<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Traits\FilterBySearch;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use FilterBySearch;

    public function index(Request $request)
    {
        $employees = Employee::withTrashed();

        $filters = [
            'name' => 'like',
            'status' => 'exact',
            'hired_at' => 'date',
        ];

        $employees = $this->applyFilters($employees, $request, $filters);

        $employees = Employee::orderBy('id')->cursorPaginate(20);

        return EmployeeResource::collection($employees);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $request->StoreEmployee();
        return response()->json(new EmployeeResource($employee));
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return new EmployeeResource($employee);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Employee not found.'
            ], 404);
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee = $request->UpdateEmployee($employee);
        return response()->json(new EmployeeResource($employee));
    }

    public function destroy(Employee $employee)
    {
        if($employee->remove()){
            return response(['message' => 'employee deleted']);
        }
        return response(['error' => 'employee does not deleted'], 409);
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        return response()->json(['message' => 'Employee restored successfully.']);
    }

}