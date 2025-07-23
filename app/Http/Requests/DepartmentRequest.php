<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $departmentId = $this->route('department')?->id ?? null;

        return [
            'name' => 'required|string|max:255|unique:departments,name,' . $departmentId,
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Department name is required.',
            'name.unique' => 'This department name already exists.',
        ];
    }

}