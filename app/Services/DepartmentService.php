<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    /**
     * Get all departments
     */
    public function getAllDepartments()
    {
       
        $departments = Department::with('users')->get();
        
       return $departments; 
    }
    
    

    /**
     * Store a new department
     */
    public function storeDepartment($validatedData)
    {
       
        $existingDepartment = Department::where('stage', $validatedData['department_stage'])->first();
    
        if ($existingDepartment) {

            $existingDepartment->update([
                'title' => $validatedData['departmentTitle'],
                'added_by' => Auth()->user()->id,
                'date_added' => now(), 
            ]);
    
            return $existingDepartment; 
        } else {
          
            $department = Department::create([
                'title' => $validatedData['departmentTitle'],
                'supervisor_id' => null,
                'stage' => $validatedData['department_stage'], 
                'added_by' => Auth()->user()->id,
                'date_added' => now(),
            ]);
    
            return $department; 
        }
    }
    


        /**
         * Update an existing department
         */
        public function updateDepartment($validatedData, Department $department)
        {
            // Check if another department with the same stage exists (excluding the current one)
            $existingDepartment = Department::where('stage', $validatedData['department_stage'])
                                            ->where('id', '!=', $department->id)
                                            ->first();

            if ($existingDepartment) {
               
                $existingDepartment->update([
                    'title' => $validatedData['departmentTitle'],
                    'supervisor_id' => null, 
                    'added_by' => Auth()->user()->id,
                    'date_added' => now(),
                ]);

                return $existingDepartment; 
            } else {
                
                $department->update([
                    'title' => $validatedData['departmentTitle'],
                    'supervisor_id' => null,
                    'stage' => $validatedData['department_stage'],
                ]);

                return $department; 
            }
        }





    /**
     * Delete a department
     */
    public function deleteDepartment(Department $department)
    {
        return $department->delete();
    }
}
