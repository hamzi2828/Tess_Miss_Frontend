<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // The fields that are mass assignable
    protected $fillable = [
        'title', 
        'is_required', 
        'require_expiry', 
        'is_linked', 
        'allowed_types', 
        'time_created', 
        'added_by', 
        'status'
    ];

    // Relationship with the User model for the 'added_by' field
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

       // Relationship with MerchantDocument model for the previous documents
       public function merchantDocuments()
       {
           return $this->hasMany(MerchantDocument::class, 'previous_doc_id');
       }
}
