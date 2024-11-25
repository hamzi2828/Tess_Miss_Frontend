<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchants';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'merchant_name',
        'merchant_name_ar',
        'merchant_qid',
        'merchant_category',
        'city',
        'address',
        'branch_address',
        'merchant_date_incorp',
        'merchant_mobile',
        'merchant_landline',
        'merchant_email',
        'merchant_uri',
        'website_month_visit',
        'website_month_active',
        'website_month_volume',
        'website_month_transaction',
        'merchant_previous_bank',
        'lat',
        'lang',
        'contract_ref_no',
        'comm_reg_no',
        'contact_person_name',
        'contact_person_mobile',
        'contact_person_email',
        'min_tran_amount',
        'max_tran_amount',
        'daily_limit_amount',
        'monthly_limit_amount',
        'max_tran_count',
        'time_created',
        'status',
        'added_by',
        'approved_by',
        'kyc_comments',
    ];

    protected $casts = [
        'merchant_date_incorp' => 'date',
        'time_created' => 'datetime',
        'status' => 'string',
        'max_tran_count' => 'integer',
    ];

    // Relationship with MerchantSale
    public function sales()
    {
        return $this->hasMany(MerchantSale::class, 'merchant_id');
    }

    // Relationship with MerchantService
    public function services()
    {
        return $this->hasMany(MerchantService::class, 'merchant_id');
    }

    // Relationship with MerchantShareholder
    public function shareholders()
    {
        return $this->hasMany(MerchantShareholder::class, 'merchant_id');
    }

    // Relationship with MerchantDocument
    public function documents()
    {
        return $this->hasMany(MerchantDocument::class, 'merchant_id');
    }

    // Relationship with the user who added the merchant
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    

    // Relationship with the user who approved KYC
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    // Relationship with the user who declined KYC
    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }


}
