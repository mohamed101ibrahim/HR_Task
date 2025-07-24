@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Department</h2>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
