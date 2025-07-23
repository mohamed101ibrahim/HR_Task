@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Departments</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control w-25 d-inline-block" placeholder="Search by name">
        <button class="btn btn-primary" id="searchBtn">Search</button>
        <a href="{{ route('departments.create') }}" class="btn btn-success float-end">Create Department</a>
    </div>

    <table class="table table-bordered" id="departmentsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.getElementById('searchBtn');
        const searchInput = document.getElementById('searchInput');

        function loadDepartments(query = '') {
            fetch(`/api/departments?name=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    const tbody = document.querySelector('#departmentsTable tbody');
                    tbody.innerHTML = '';

                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="3">No departments found.</td></tr>';
                        return;
                    }

                    data.data.forEach(dept => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${dept.id}</td>
                                <td>${dept.name}</td>
                                <td>
                                    <a href="/departments/${dept.id}" class="btn btn-success btn-sm">View</a>
                                    <a href="/departments/${dept.id}/edit" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="/departments/${dept.id}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                });
        }

        loadDepartments();

        searchBtn.addEventListener('click', () => {
            const query = searchInput.value;
            loadDepartments(query);
        });
    });
</script>
@endpush
