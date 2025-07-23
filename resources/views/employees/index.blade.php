@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success">+ Create New Employee</a>
    </div>

    <div class=" mb-4">
        <div class="card-body">
            <form action="{{ route('employees.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="name" class="form-label">Search Name</label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}" class="form-control" placeholder="e.g., Mohamed">
                </div>

                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="hired_at" class="form-label">Hired Date</label>
                    <input type="date" name="hired_at" id="hired_at" value="{{ request('hired_at') }}" class="form-control">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center" id="employeesTable">
            <thead class="table-light">
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
        <div id="noResults" class="text-center text-muted py-4 d-none">
            <p>No employees found for the given search criteria.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    loadEmployees();
});

function loadEmployees() {
    const name = document.querySelector('[name="name"]').value;
    const status = document.querySelector('[name="status"]').value;
    const hired_at = document.querySelector('[name="hired_at"]').value;

    const query = new URLSearchParams({ name, status, hired_at }).toString();

    fetch(`/api/employees?${query}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#employeesTable tbody');
            const noResults = document.getElementById('noResults');
            tbody.innerHTML = '';

            if (data.data.length === 0) {
                noResults.classList.remove('d-none');
                return;
            }

            noResults.classList.add('d-none');

            data.data.forEach(emp => {
                const hiredDate = new Date(emp.hired_at);
                const formattedDate = hiredDate.toISOString().split('T')[0];
                const rowClass = emp.deleted_at ? 'table-secondary' : '';

                const actionButtons = emp.deleted_at
                ? `<button class="btn btn-success btn-sm" onclick="restoreEmployee(${emp.id})">Restore</button>`
                : `
                    <a href="/employees/${emp.id}/edit" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${emp.id})">Delete</button>
                `;

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
                        <td>${emp.department ? emp.department.name : 'N/A'}</td>
                        <td>${actionButtons}</td>
                    </tr>`;
            });
        });
}

window.deleteEmployee = function(id) {
    fetch(`/api/employees/${id}`, { method: 'DELETE' }).then(() => loadEmployees());
};

window.restoreEmployee = function(id) {
    fetch(`/api/employees/${id}/restore`, { method: 'PATCH' }).then(() => loadEmployees());
};

document.addEventListener('DOMContentLoaded', () => {
    loadEmployees();

    document.querySelector('[name="name"]').addEventListener('input', loadEmployees);
    document.querySelector('[name="status"]').addEventListener('change', loadEmployees);
    document.querySelector('[name="hired_at"]').addEventListener('change', loadEmployees);
});

</script>
@endpush