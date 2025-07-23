<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DepartmentController;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('departments',DepartmentController::class);

Route::patch('/employees/{id}/restore', [EmployeeController::class, 'restore']);