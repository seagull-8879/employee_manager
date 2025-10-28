@extends('layout')
@section('title', 'Edit Department')
@section('content')
<body>
    <h2>Edit Department</h2>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ $department->name }}" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="3">{{ $department->description }}</textarea><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('departments.index') }}">← Back to Department List</a>
</body>
</html>