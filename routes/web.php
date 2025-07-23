<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestPaginationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-offset', [TestPaginationController::class, 'offset']);
Route::get('/test-cursor', [TestPaginationController::class, 'cursor']);

// Route::middleware(['auth', 'web'])->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::post('/{id}/restore', [EmployeeController::class, 'restore'])->name('restore');
        Route::resource('departments', DepartmentController::class);

        // });