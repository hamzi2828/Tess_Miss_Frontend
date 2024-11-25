<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $departments = $this->departmentService->getAllDepartments();
        $users = User::all();
        return view('pages.department.department-list', compact('departments', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Validate the incoming request
        $validatedData = $request->validate([
            'departmentTitle' => 'required|string|max:255',
            'department_stage' => 'required|in:1,2,3,4',
        ]);

        // Call the service to store the department
        $this->departmentService->storeDepartment($validatedData);

        // Redirect to the departments page with success message
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'departmentTitle' => 'required|string|max:255',
            'department_stage' => 'required|integer|in:1,2,3,4',
        ]);

      
        // Call the service to update the department
        $this->departmentService->updateDepartment($validatedData, $department);

        // Redirect back with a success message
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Call the service to delete the department
        $this->departmentService->deleteDepartment($department);

        // Redirect back with a success message
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
