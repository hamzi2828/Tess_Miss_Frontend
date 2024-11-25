<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantSale extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural form of the model
    protected $table = 'merchant_sales';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'merchant_id',
        'min_transaction_amount',
        'max_transaction_amount',
        'daily_limit_amount',
        'monthly_limit_amount',
        'max_transaction_count',
        'added_by',
        'approved_by',
    ];
    

    // Define the relationship with the User model for the 'added_by' field
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Define the relationship with the User model for the 'approved_by' field
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Define the relationship with the User model for the 'declined_by' field
    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    // Define the relationship with the Merchant model
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

}
