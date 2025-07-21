<?php

namespace App\Http\Requests;

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
}