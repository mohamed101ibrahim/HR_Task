@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Employee</h2>

    <form id="employeeForm" action="{{ route('employees.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            <span class="text-danger" id="nameError">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            <span class="text-danger" id="emailError">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            <span class="text-danger" id="phoneError">{{ $errors->first('phone') }}</span>
        </div>

        <div class="form-group">
            <label>Position:</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}" required>
            <span class="text-danger" id="positionError">{{ $errors->first('position') }}</span>
        </div>

        <div class="form-group">
            <label for="department_id">Department:</label>
            <select name="department_id" class="form-control" required>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}" disabled >{{ $department->name }}</option>
                @endforeach
              </select>
              <span class="text-danger" id="departmentError">{{ $errors->first('department_id') }}</span>
        </div>

        <div class="form-group">
            <label>Salary:</label>
            <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') }}" required>
            <span class="text-danger" id="salaryError">{{ $errors->first('salary') }}</span>
        </div>

        <div class="form-group">
            <label>Hired At:</label>
            <input type="date" name="hired_at" id="hired_at" class="form-control" value="{{ old('hired_at') }}" required>
            <span class="text-danger" id="hiredAtError">{{ $errors->first('hired_at') }}</span>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <span class="text-danger" id="statusError">{{ $errors->first('status') }}</span>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Create Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('employeeForm');

        form.addEventListener('input', validateField);
        form.addEventListener('blur', validateField, true);

        function validateField(e) {
            const field = e.target;
            const fieldName = field.name;
            const errorSpan = document.getElementById(fieldName + 'Error');
            let errorMessage = '';

            switch (fieldName) {
                case 'name':
                    if (field.value.trim() === '') {
                        errorMessage = 'Employee name is required.';
                    } else if (!/^[A-Za-z\s]+$/.test(field.value.trim())) {
                        errorMessage = 'Employee name must contain only letters and spaces.';
                    } else if (field.value.length > 100) {
                        errorMessage = 'Employee name cannot exceed 100 characters.';
                    }
                    break;
                case 'email':
                    if (field.value.trim() === '') {
                        errorMessage = 'Email is required.';
                    } else if (!/^\S+@\S+\.\S+$/.test(field.value)) {
                        errorMessage = 'Email must be a valid email address.';
                    }
                    break;

                case 'phone':
                    if (field.value && !/^(\+?\d{8,15})$/.test(field.value)) {
                        errorMessage = 'Phone must be digits only or start with "+" followed by digits.';
                    }
                    break;

                case 'position':
                    if (field.value.trim() === '') {
                        errorMessage = 'Position is required.';
                    } else if (field.value.length > 100) {
                        errorMessage = 'Position cannot exceed 100 characters.';
                    }
                    break;

                case 'salary':
                    if (field.value.trim() === '') {
                        errorMessage = 'Salary is required.';
                    } else if (parseFloat(field.value) < 0) {
                        errorMessage = 'Salary must be a positive number.';
                    }
                    break;

                case 'hired_at':
                    if (field.value === '') {
                        errorMessage = 'Hire date is required.';
                    } else {
                        const today = new Date().toISOString().split('T')[0];
                        if (field.value > today) {
                            errorMessage = 'Hire date cannot be in the future.';
                        }
                    }
                    break;

                case 'status':
                    if (field.value !== 'active' && field.value !== 'inactive') {
                        errorMessage = 'Status must be either active or inactive.';
                    }
                    break;

                case 'department':
                    if (field.value.trim() === '') {
                        errorMessage = 'Department is required.';
                    }
                    break;

            if (errorMessage === '') {
                errorSpan.textContent = '';
            } else {
                errorSpan.textContent = errorMessage;
            }
    }
}
    });

</script>

@endsection