<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Traits\FilterBySearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{
    use FilterBySearch;

    public function index(Request $request)
    {
        $cacheKey = 'employees_index_' . md5(json_encode($request->all()));

        $employees = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Employee::with(['department'])->withTrashed();

            $filters = [
                'name' => 'like',
                'status' => 'exact',
                'hired_at' => 'date',
            ];

            $query = $this->applyFilters($query, $request, $filters);

            return $query->paginate(10);
        });

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