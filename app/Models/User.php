<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; // Include SoftDeletes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'department',
        'role',
        'status',
        'picture',
        'address',
        'userGender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime', // Cast for soft delete
    ];

    /**
     * Soft delete functionality.
     *
     * @var array<string, string>
     */
    protected $dates = ['deleted_at']; // Soft delete column

  

    /**
     * Relationship: Departments added by the user.
     */
    public function addedDepartments()
    {
        return $this->hasMany(Department::class, 'added_by');
    }

    /**
     * Relationship: Permissions of the user.
     */

    public function permissions()
    {
        return $this->hasOne(UserPermission::class, 'user_id');
    }

    /** approved_by relationship of the merchant */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relationship: Merchants approved by the user.
     */
    public function approvedMerchants()
    {
        return $this->hasMany(Merchant::class, 'approved_by'); 
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department'); 
    }

    public function getDepartmentTitle($departmentId)
    {
        
        $department = Department::find($departmentId);
        return $department ? $department->title : 'N/A';
    }
    public function getDepartmentStage($departmentId)
    {
        
        $department = Department::find($departmentId);
        return $department ? $department->stage : 'N/A';
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id'); 
    }

    
    
}
