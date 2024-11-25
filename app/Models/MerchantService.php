<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantService extends Model
{
    use HasFactory;

    protected $table = 'merchant_services';

    protected $fillable = [
        'merchant_id',
        'service_id',
        'field_name',
        'field_value',
        'added_by',
        'approved_by',
        'status',
    ];

    // Relationship with Merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Relationship with User (added_by)
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relationship with User (approved_by)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Relationship with User (declined_by)
    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    // Relationship with the ServiceType model
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_id');
    }

}
