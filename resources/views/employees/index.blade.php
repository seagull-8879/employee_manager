@extends('layout')

@section('title', 'Employees')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
    </div>

    <form method="GET" action="{{ route('employees.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>
                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info text-white">View</a>
                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="photo" width="50" />
                        @else
                            No photo
                        @endif
                    </td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone_number }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ number_format($employee->salary, 2) }}</td>
                    <td>{{ $employee->join_date->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" style="background-color: orange; color: white; padding: : 5px 10px;">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No employees found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
