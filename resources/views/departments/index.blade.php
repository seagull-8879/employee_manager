@extends('layout')
@section('title', 'Departments')
@section('content')
<body>
    <h2>Department List</h2>

    <a href="{{ route('departments.create') }}">+ Add Department</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Total Employees</th>
            <th>Actions</th>
        </tr>

        @foreach ($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>{{ $department->employees_count }}</td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}">View</a> |
                    <a href="{{ route('departments.edit', $department->id) }}">Edit</a> |
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>