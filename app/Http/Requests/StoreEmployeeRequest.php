<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:15',
            'position' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'hired_at' => 'required|date',
            'status' => 'required|in:active,inactive',
        ];
    }
    public function prepareForValidation(): void
    {
        $this->merge([
            // 'salary' => floatval($this->salary),
            'status' => strtolower($this->status),
        ]);
    }

    public function StoreEmployee(){
        return DB::transaction(function () {
            $employee = Employee::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'position' => $this->position,
                'salary' => $this->salary,
                'hired_at' => $this->hired_at,
                'status' => $this->status,
            ]);
            return $employee->refresh();
        });
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Employee name is required.',
            'name.string' => 'Employee name must be a string.',
            'name.max' => 'Employee name can have max 100 characters.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already used.',

            'phone.string' => 'Phone number must be a string.',
            'phone.max' => 'Phone number cannot exceed 15 characters.',

            'position.required' => 'Position is required.',
            'position.string' => 'Position must be a string.',

            'salary.required' => 'Salary is required.',
            'salary.numeric' => 'Salary must be a number.',
            'salary.min' => 'Salary must be at least 0.',

            'hired_at.required' => 'Hire date is required.',
            'hired_at.date' => 'Hire date must be a valid date.',

            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either active or inactive.',
        ];
    }

}