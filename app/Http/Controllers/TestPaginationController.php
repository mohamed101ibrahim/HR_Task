<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class TestPaginationController extends Controller
{
    public function offset(Request $request)
    {
        $start = microtime(true);

        $employees = Employee::paginate(20);

        $time = microtime(true) - $start;

        return response()->json([
            'method' => 'offset',
            'time' => $time,
            'data' => $employees->items()
        ]);
    }

    public function cursor(Request $request)
    {
        $start = microtime(true);

        $employees = Employee::orderBy('id')->cursorPaginate(20);

        $time = microtime(true) - $start;

        return response()->json([
            'method' => 'cursor',
            'time' => $time,
            'data' => $employees->items()
        ]);
    }
}