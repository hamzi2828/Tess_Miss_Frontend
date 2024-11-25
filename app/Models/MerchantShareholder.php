<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantShareholder extends Model
{
    use HasFactory;

    protected $table = 'merchant_shareholders';

    protected $fillable = [
        'title',
        'country', // This should reference the country ID
        'qid',
        'merchant_id',
        'added_by',
        'time_created',
        'status',
    ];

    /**
     * Define the relationship with the Merchant model.
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * Define the relationship with the User model (for 'added_by' column).
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * Define the relationship with the Country model.
     * Each shareholder belongs to one country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country');
    }
}
