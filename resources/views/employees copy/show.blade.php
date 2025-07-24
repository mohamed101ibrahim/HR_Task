@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Department: {{ $department->name }}</h2>

    <h4 class="mt-4">Employees in this department:</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hired At</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($employees as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->hired_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No employees found.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        <nav>
            <ul class="pagination pagination-md gap-2">
                @if ($employees->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link px-4" href="{{ $employees->previousPageUrl() }}">« Previous</a>
                    </li>
                @endif
                @if ($employees->nextPageUrl())
                <li class="page-item">
                    <a class="page-link px-4" href="{{ $employees->nextPageUrl() }}">Next »</a>
                </li>
            @endif
        </ul>
    </nav>
</div>

    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments</a>
</div>
@endsection
