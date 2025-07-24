@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label>Position:</label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
        </div>
        <div class="form-group">
            <label for="department_id">Department:</label>
            <select name="department_id" class="form-control" required>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
              </select>
        </div>
        <div class="form-group">
            <label>Salary:</label>
            <input type="number" name="salary" class="form-control" value="{{ old('salary') }}" required>
        </div>

        <div class="form-group">
            <label>Hired At:</label>
            <input type="date" name="hired_at" class="form-control" value="{{ old('hired_at') }}" required>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Create Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
