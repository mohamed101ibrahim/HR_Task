@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    <ul>
        <li><strong>ID:</strong> {{ $employee->id }}</li>
        <li><strong>Name:</strong> {{ $employee->name }}</li>
        <li><strong>Email:</strong> {{ $employee->email }}</li>
        <li><strong>Phone:</strong> {{ $employee->phone }}</li>
        <li><strong>Position:</strong> {{ $employee->position }}</li>
        <li><strong>Salary:</strong> {{ $employee->salary }}</li>
        <li><strong>Status:</strong> {{ $employee->status }}</li>
        <li><strong>Hired At:</strong> {{ $employee->hired_at }}</li>
    </ul>
    <a href="/" class="btn btn-primary">Back to List</a>
</div>
@endsection
