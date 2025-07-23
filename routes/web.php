<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware(['auth', 'web'])->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::post('/{id}/restore', [EmployeeController::class, 'restore'])->name('restore');
        Route::resource('departments', DepartmentController::class);

        // });