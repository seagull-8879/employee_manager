@extends('layout')
@section('title', 'Edit Employee')
@section('content')
<body>
    <h2>Edit Employee</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $employee->name) }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" required><br><br>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
        <br>

        <label>Position:</label><br>
        <input type="text" name="position" value="{{ old('position', $employee->position) }}" required><br><br>

        <label>Salary:</label><br>
        <input type="number" step="0.01" name="salary" value="{{ old('salary', $employee->salary) }}" required><br><br>

        <label>Join Date:</label><br>
        <input type="date" name="join_date" value="{{ old('join_date', $employee->join_date->format('Y-m-d')) }}" required><br><br>

        <label>Photo:</label><br>
        <input type="file" name="photo"><br>
        @if ($employee->photo)
            <img src="{{ asset('storage/' . $employee->photo) }}" width="100" alt="Employee photo"><br>
        @endif
        <br>

        <button type="submit">Update Employee</button>
    </form>
</body>
</html>