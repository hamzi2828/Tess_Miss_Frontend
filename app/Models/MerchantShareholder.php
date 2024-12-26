<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantShareholder extends Model
{
    use HasFactory;

    protected $table = 'merchant_shareholders';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'title',
        'country',
        'qid',
        'merchant_id',
        'added_by',
        'time_created',
        'status',
        'sanctions_check_status',
        'sanctions_check_date',
        'sanctions_check_result',
        'has_sanctions_match',
        'sanctions_score'
        ];

        protected $casts = [
            'sanctions_check_result' => 'array',
            'sanctions_check_date' => 'datetime',
            'has_sanctions_match' => 'boolean',
            'dob' => 'date'
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
    // In MerchantShareholder.php
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
