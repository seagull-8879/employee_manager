<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    //defines a public function named index accepts a Request object as a parameter.
    //and type hinted that it will return a view.
    {
        $search = $request->query('search');
        //intended to retireve value of query parameter and assign it to $search variable.

        if($search){
            $employees = Employee::where('name','like','%'.$search.'%')
            ->orderBy('id','desc')
            ->get();
        } else {
            $employees = Employee::orderBy('id','desc')->get();
        }
        //conditional block checks if $search has a value.
        //if it is true it performs a database query to retrieve employees whose names match the search term using a "like" clause.
        //results ordered by id in descending order and stored in $employees variable.
        //if $search is empty it retrieves all employees ordered by id in descending order.

        return view('employees.index', compact('employees','search'));
        //returns a view named 'employees.index' and passes the $employees and $search variables to it using compact function.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $departments = Department::all();
        //retrieves all records from the Department model and stores them in the $departments variable
        return view('employees.create', compact('departments'));
        //renders and returns a view named 'employees.create' which likely contains a 
        //form for creating a new employee record.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        //validation rules for incoming request data.
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required|unique:employees,phone_number',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric',
            'join_date' => 'required|date',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employee_photos', 'public');
            $validated['photo'] = $path;
            //handles file upload for employee photo.
            //if a photo file is present in the request it stores the file in 'employee_photos' directory within the public disk.
            //the path to the stored file is then added to the $validated array under the 'photo' key.
        }
        Employee::create($validated);
        //creates a new employee record in the database using the validated data.
        return redirect()->route('employees.index')
        ->with('success','employee created successfully.');
        //redirects the user to the employees index route with a success message indicating that the employee was created successfully.
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
        //returns a view named 'employees.show' and passes the $employee variable to it
        // using compact function.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        
        $departments = Department::all();
        //retrieves all records from the Department model and stores them in the $departments variable
        return view('employees.edit', compact('employee','departments'));
        //renders and returns a view named 'employees.edit' 
        //passing the $employee variable to it using compact function.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
        //validation rules for updating an existing employee record.
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            //email must be unique in employees table except for the current employee being updated.
            'phone_number' => 'required|string|unique:employees,phone_number,' . $employee->id,
            //phone_number must be unique in employees table except for the current employee being updated.
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'join_date' => 'required|date',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            // Check if there's an existing photo and delete it
            if ($employee->photo && Storage::disk('public')->exists($employee->photo)){
                //checks if the employee has an existing photo and if it exists in the public disk.
                Storage::disk('public')->delete($employee->photo);
                //deletes the existing photo from storage.
            }
            $path = $request->file('photo')->store('employee_photos', 'public');
            $validated['photo'] = $path;
            //stores the new photo and updates the 'photo' key in the $validated array with the new path.
            //handles file upload for updated employee photo.
        
        }   
        $employee->update($validated);
        //updates the employee record in the database with the validated data.
        return redirect()->route('employees.index')
        ->with('success','employee updated successfully.');
        //redirects the user to the employees index route with a success message indicating that the employee


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
            //checks if the employee has an associated photo and if it exists in the public disk.
            //if both conditions are true it deletes the photo from storage.
        }
        $employee->delete();
        //deletes the employee record from the database.
        return redirect()->route('employees.index')
        ->with('success','employee deleted successfully.');
        //redirects the user to the employees index route with a success message indicating that the employee
    }
}
