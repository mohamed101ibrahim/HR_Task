<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Traits\FilterBySearch;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use FilterBySearch;


    public function index(Request $request)
    {
        $departments = Department::query();

        $filters = [
            'name' => 'like',
        ];
        $departments = $this->applyFilters($departments, $request, $filters);
        $departments = $departments->orderBy('id', 'asc')->paginate(10);

        // $departments = $departments->latest()->paginate(10);

        return response()->json($departments);

    }

    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return response()->json([
            'message' => 'Department created successfully.',
            'data' => $department
        ], 201);
    }

    public function show(Department $department)
    {
        return response()->json([
            'data' => $department
        ]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return response()->json([
            'message' => 'Department updated successfully.',
            'data' => $department
        ]);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully.'
        ]);
    }
}