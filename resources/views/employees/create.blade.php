@extends('layout')
@section('title', 'Add Employee')
@section('content')

<div class="container">
    <h1>Add Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" value="{{ old('email') }}" class="form-control" type="email" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone_number" value="{{ old('phone_number') }}" class="form-control" required>
            @error('phone_number') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input name="position" value="{{ old('position') }}" class="form-control" required>
            @error('position') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input name="salary" value="{{ old('salary') }}" class="form-control" type="number" step="0.01" required>
            @error('salary') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Join Date</label>
            <input name="join_date" value="{{ old('join_date') }}" class="form-control" type="date" required>
            @error('join_date') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>

        <div class="mb-3">
            <label class="form-label">Photo (optional)</label>
            <input name="photo" class="form-control" type="file" accept="image/*">
            @error('photo') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <br>
        <br>

        <button class="btn btn-primary" type="submit">Save</button>
        
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>