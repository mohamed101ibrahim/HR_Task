<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;

Route::apiResource('employees', EmployeeController::class);
Route::patch('/employees/{id}/restore', [EmployeeController::class, 'restore']);