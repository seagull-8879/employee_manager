@extends('layout')
@section('title', 'Employee Details')
@section('content')
<body class="p-4 bg-light">
<div class="container">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Employee Details</h3>
            <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm">← Back</a>
        </div>

        <div class="card-body p-4">
            <div class="row">
                <!-- Photo Section -->
                <div class="col-md-4 text-center">
                    @if($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" 
                             alt="Employee Photo" class="img-fluid rounded mb-3 shadow" 
                             style="max-width: 250px;">
                    @else
                        <div class="text-muted fst-italic">No photo uploaded</div>
                    @endif
                </div>

                <!-- Details Section -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Name:</th>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $employee->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td>{{ $employee->department->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td>{{ $employee->position }}</td>
                        </tr>
                        <tr>
                            <th>Salary:</th>
                            <td>₹{{ number_format($employee->salary, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Join Date:</th>
                            <td>{{ \Carbon\Carbon::parse($employee->join_date)->format('F j, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $employee->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $employee->updated_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-end">
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('employees.destroy', $employee) }}" method="POST" 
                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>