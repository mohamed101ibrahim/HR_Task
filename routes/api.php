<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\TestPaginationController;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('departments',DepartmentController::class);
Route::get('/test-offset', [TestPaginationController::class, 'offset']);
Route::get('/test-cursor', [TestPaginationController::class, 'cursor']);
Route::patch('/employees/{id}/restore', [EmployeeController::class, 'restore']);