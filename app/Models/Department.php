<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes; // Adding the SoftDeletes trait

    protected $fillable = ['title', 'supervisor_id', 'added_by', 'date_added', 'stage'];

    // Relationship with the User model for Supervisor
    public function users()
    {
        return $this->hasMany(User::class, 'department'); 
    }

    // Relationship with the User model for Added By
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Method to get the department title by ID
    public function getDepartmentTitle($departmentId)
    {
        $department = Department::find($departmentId);
        return $department ? $department->title : 'N/A';
    }
}
