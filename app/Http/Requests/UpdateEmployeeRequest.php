<?php

namespace App\Http\Requests;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee')->id;

        return [
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:employees,email,' . $employeeId,
            'phone' => 'sometimes|string|max:15',
            'position' => 'sometimes|string',
            'salary' => 'sometimes|numeric|min:0',
            'hired_at' => 'sometimes|date',
            'status' => 'sometimes|in:active,inactive',
        ];
    }
    public function updateEmployee(Employee $employee)
    {
        return DB::transaction(function () use ($employee) {
            $employee->update([
                'name'      => $this->input('name', $employee->name),
                'email'     => $this->input('email', $employee->email),
                'phone'     => $this->input('phone', $employee->phone),
                'position'  => $this->input('position', $employee->position),
                'salary'    => $this->input('salary', $employee->salary),
                'hired_at'  => $this->input('hired_at', $employee->hired_at),
                'status'    => $this->input('status', $employee->status),
            ]);

            return $employee->refresh();
        });
    }
}