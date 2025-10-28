<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::withCount("employees")->get();
        // retrieves all departments with a count of their associated employees
        return view("departments.index", compact("departments"));
        // returns the 'departments.index' view with the departments data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("departments.create");
        // returns the 'departments.create' view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            //name and description fields validation rules
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
        ]);
        Department::create($validated);
        // creates a new department record with the validated data
        return redirect()->route('departments.index')->with('success','department created successfully.');
        // redirects to the department index route with a success message 
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load('employees');
        // loads the employees relationship for the specified department
        return view('departments.show', compact('department'));
        // returns the 'departments.show' view with the department data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
        // returns the 'departments.edit' view with the department data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            //name and description fields validation rules
            'name' => 'required|string|max:255|unique:departments,name,'.$department->id,
            'description' => 'nullable|string',
        ]);
        $department->update($validated);
        // updates the specified department record with the validated data
        return redirect()->route('departments.index')->with('success','department updated successfully.');
        // redirects to the department index route with a success message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        // deletes the specified department record
        return redirect()->route('departments.index')->with('success','department deleted successfully.');
        // redirects to the department index route with a success message
    }
}
