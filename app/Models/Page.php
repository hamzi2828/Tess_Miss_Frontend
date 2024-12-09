<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    // Explicitly define the table name if it differs from the default ('pages')
    protected $table = 'pages';

    // Allow mass assignment for the specified fields
    protected $fillable = ['name', 'slug', 'description', 'status'];

    /**
     * Boot method for the model.
     * Automatically generates a slug from the name if not provided.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            // Generate a unique slug based on the name
            $page->slug = Str::slug($page->name, '-');
        });

        static::updating(function ($page) {
            // Update the slug if the name changes
            $page->slug = Str::slug($page->name, '-');
        });
    }

    /**
     * Optional: Define a custom accessor for the URL of the page.
     */
    public function getUrlAttribute()
    {
        return url('/page/' . $this->slug);
    }
}
