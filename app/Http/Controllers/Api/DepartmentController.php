<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        $departments = Department::query();

        if ($request->has('name') && $request->filled('name')) {
            $departments->where('name', 'like', '%' . $request->name . '%');
        }

        return response()->json([
            'data' => $departments->latest()->get(),
        ]);
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