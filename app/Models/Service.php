<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fields',
        'added_by',
        'date_added',
    ];

    // Cast 'fields' as an array and 'date_added' as a date
    protected $casts = [
        'fields' => 'array',
        'date_added' => 'datetime', // This ensures 'date_added' is treated as a date
    ];

    // Relationship with User (who added the service)
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
