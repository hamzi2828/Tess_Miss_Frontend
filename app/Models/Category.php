<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'image', 'description', 'status'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}