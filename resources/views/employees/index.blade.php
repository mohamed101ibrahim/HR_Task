@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employees</h2>

    <table class="table table-bordered" id="employeesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Hired At</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create New Employee</a>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    loadEmployees();
});

function loadEmployees() {
    fetch('/api/employees')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#employeesTable tbody');
            tbody.innerHTML = '';

            data.data.forEach(emp => {
                const hiredDate = new Date(emp.hired_at);
                const formattedDate = hiredDate.toISOString().split('T')[0];
                const rowClass = emp.deleted_at ? 'table-secondary' : '';

                const actionButtons = emp.deleted_at ? `<button class="btn btn-success btn-sm" onclick="restoreEmployee(${emp.id})">Restore</button>`
                    : `<button class="btn btn-danger btn-sm" onclick="deleteEmployee(${emp.id})">Delete</button>
                       <a href="/employees/${emp.id}/edit" class="btn btn-primary btn-sm">Edit</a>`;

                tbody.innerHTML += `
                    <tr class="${rowClass}">
                        <td>${emp.id}</td>
                        <td>${emp.name}</td>
                        <td>${emp.email}</td>
                        <td>${emp.phone}</td>
                        <td>${emp.position}</td>
                        <td>${emp.salary}</td>
                        <td>${emp.status}</td>
                        <td>${formattedDate}</td>
                        <td>${actionButtons}</td>
                        <td>${emp.department ? emp.department.name : 'N/A'}</td>
                    </tr>`;
            });
        });
}

window.deleteEmployee = function(id) {
    fetch(`/api/employees/${id}`, { method: 'DELETE' })
        .then(() => loadEmployees());
}

window.restoreEmployee = function(id) {
    fetch(`/api/employees/${id}/restore`, { method: 'PATCH' })
        .then(() => loadEmployees());
}
</script>
@endpush
