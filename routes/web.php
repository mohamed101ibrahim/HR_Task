<?php
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware(['auth', 'web'])->group(function () {
    // Employee Blade routes
    // Route::prefix('employees')->name('employees.')->group(function () {
    //     Route::get('/', [EmployeeController::class, 'index'])->name('index');
    //     Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    //     Route::post('/', [EmployeeController::class, 'store'])->name('store');
    //     Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
    //     Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    //     Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    //     Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    //     Route::post('/{id}/restore', [EmployeeController::class, 'restore'])->name('restore');
    // });
// });