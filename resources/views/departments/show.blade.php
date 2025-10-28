@extends('layout')
@section('title', 'Department Details')
@section('content')
<body>
    <h2>Department: {{ $department->name }}</h2>
    <p><strong>Description:</strong> {{ $department->description ?? 'N/A' }}</p>

    <h3>Employees in this Department</h3>

    @if($department->employees->count() > 0)
        <table border="1" cellpadding="8">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Join Date</th>
            </tr>
            @foreach ($department->employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->join_date->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No employees found in this department.</p>
    @endif

    <br>
    <a href="{{ route('departments.index') }}">← Back to Departments</a>
</body>
</html>