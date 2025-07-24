<?php

namespace App\Http\Controllers;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Traits\FilterBySearch;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use FilterBySearch;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::query();

        $filters = [
            'name' => 'like',
        ];
        $departments = $this->applyFilters($departments, $request, $filters);
        $departments = $departments->orderBy('id', 'asc')->paginate(10);

        // $departments = $departments->paginate(10);

        return view('departments.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $employees = $department->employees()->paginate(10);

        return view('departments.show', compact('department', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')->with('success', 'Department updated.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}