@extends('layout')
@section('title', 'Add Department')
@section('content')
<body>
    <h2>Add New Department</h2>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="3"></textarea><br><br>

        <button type="submit">Save</button>
    </form>

    <br>
    <a href="{{ route('departments.index') }}">← Back to Department List</a>
</body>
</html>