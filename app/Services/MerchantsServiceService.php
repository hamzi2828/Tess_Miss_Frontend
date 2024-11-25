<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\MerchantDocument;
use App\Models\MerchantSale;
use App\Models\MerchantShareholder;
use App\Models\MerchantService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MerchantActivityNotification;


class MerchantsServiceService
{

    // public function getAllMerchants(): array
    // {
    //     $merchants = Merchant::with([
    //         'sales.addedBy', 'sales.approvedBy', 
    //         'services.addedBy', 'services.approvedBy', 
    //         'shareholders', 
    //         'documents.addedBy', 'documents.approvedBy',
    //         'addedBy', 'approvedBy'])->get()->toArray();
    //     return $merchants;
    // }
    
    public function getAllMerchants($merchantId = null): array 
        {
            // Build the query with eager loading for related data
            $query = Merchant::with([
                'sales.addedBy', 
                'sales.approvedBy', 
                'sales.declinedBy',
                'services.addedBy', 
                'services.approvedBy', 
                'services.declinedBy',
                'shareholders', 
                'documents.addedBy', 
                'documents.approvedBy',
                'documents.declinedBy',
                'addedBy', 
                'approvedBy',
                'declinedBy'
            ]);

            // Apply filtering if merchantId is provided
            if ($merchantId) {
                $query->where('id', $merchantId);
            }

            // dd($query->get()->toArray());
            // Fetch the data and convert to array
            return $query->get()->toArray();
        }

 
    public function createMerchants(array $data): Merchant
    {
        // Create the merchant record
        $merchant = new Merchant();
        $merchant->merchant_name = $data['merchant_name']; 
        $merchant->merchant_name_ar = $data['merchant_arabic_name']; 
        $merchant->comm_reg_no = $data['company_registration']; 
        $merchant->address = $data['company_address']; 
        $merchant->merchant_mobile = $data['mobile_number']; 
        $merchant->merchant_category = $data['company_activities'];
        $merchant->merchant_landline = $data['landline_number']; 
        $merchant->merchant_url = $data['website']; 
        $merchant->merchant_email = $data['email']; 
        $merchant->website_month_visit = $data['monthly_website_visitors']; 
        $merchant->contact_person_name = $data['key_point_of_contact']; 
        $merchant->website_month_active = $data['monthly_active_users']; 
        $merchant->contact_person_mobile = $data['key_point_mobile']; 
        $merchant->website_month_volume = $data['monthly_avg_volume']; 
        $merchant->merchant_previous_bank = $data['existing_banking_partner']; 
        $merchant->website_month_transaction = $data['monthly_avg_transactions']; 
        $merchant->merchant_date_incorp = $data['date_of_incorporation']; 
        $merchant->added_by = Auth::user()->id ; 
        $merchant->save();
        
           // Load the addedBy relationship
            $merchant->load('addedBy');

        // Handle Shareholders
        $this->createShareholders($merchant, $data);
        
        return $merchant;
    }

  
    protected function createShareholders(Merchant $merchant, array $data): void
    {
        $shareholderNames = $data['shareholderName'];
        $shareholderNationalities = $data['shareholderNationality'];
        $shareholderIDs = $data['shareholderID'];

        foreach ($shareholderNames as $index => $shareholderName) {
            $shareholder = new MerchantShareholder();
            $shareholder->merchant_id = $merchant->id;
            $shareholder->title = $shareholderName;
            $shareholder->country_id = $shareholderNationalities[$index]; 
            $shareholder->qid = $shareholderIDs[$index] ?? null; 
            $shareholder->added_by = Auth::user()->id ?? 1; 
            $shareholder->status = 'active'; 
            $shareholder->save();
        }
    }



    public function storeMerchantsSales(array $data, int $merchant_id): MerchantSale
    {
        $merchant_id = $merchant_id;  // Example merchant ID, replace with dynamic value if needed
     
         // Step 2: Create a new MerchantSale record using validated data
         $merchantSale = new MerchantSale();
         $merchantSale->merchant_id = $merchant_id;
         $merchantSale->min_transaction_amount = $data['minTransactionAmount'];
         $merchantSale->max_transaction_amount = $data['maxTransactionAmount'];
         $merchantSale->daily_limit_amount = $data['dailyLimitAmount'];
         $merchantSale->monthly_limit_amount = $data['monthlyLimitAmount'];
         $merchantSale->max_transaction_count = $data['maxTransactionCount'];
         $merchantSale->added_by = auth()->user()->id ?? 1;  // Use the authenticated user, default to 1 if not available
     
         // Save the merchant sale record
         $merchantSale->save();
         return $merchantSale;

    }


    public function storeMerchantsServices(array $data, int $merchant_id)
    {
        
        // Step 1: Iterate over the services and save each field in the merchant_services table
        foreach ($data['services'] as $service_id => $serviceData) {
            // Get the fields for this service
            $fields = $serviceData['fields'];
            
            // Save each field
            foreach ($fields as $index => $fieldValue) {
                MerchantService::create([
                    'merchant_id' => $merchant_id,
                    'service_id' => $service_id,
                    'field_name' => 'Field ' . $index, 
                    'field_value' => $fieldValue ?? '',
                    'added_by' => Auth::user()->id ?? 1, 
                    'status' => true, 
                ]);
            }
        }
    }



    public function updateMerchants(array $data, int $merchant_id): Merchant
    {
        // Find the existing merchant
        $merchant = Merchant::findOrFail($merchant_id);
        
        // Update merchant fields
        $merchant->merchant_name = $data['merchant_name']; 
        $merchant->merchant_name_ar = $data['merchant_arabic_name']; 
        $merchant->comm_reg_no = $data['company_registration']; 
        $merchant->address = $data['company_address']; 
        $merchant->merchant_mobile = $data['mobile_number']; 
        $merchant->merchant_category = $data['company_activities'];
        $merchant->merchant_landline = $data['landline_number']; 
        $merchant->merchant_url = $data['website']; 
        $merchant->merchant_email = $data['email']; 
        $merchant->website_month_visit = $data['monthly_website_visitors']; 
        $merchant->contact_person_name = $data['key_point_of_contact']; 
        $merchant->website_month_active = $data['monthly_active_users']; 
        $merchant->contact_person_mobile = $data['key_point_mobile']; 
        $merchant->website_month_volume = $data['monthly_avg_volume']; 
        $merchant->merchant_previous_bank = $data['existing_banking_partner']; 
        $merchant->website_month_transaction = $data['monthly_avg_transactions']; 
        $merchant->merchant_date_incorp = $data['date_of_incorporation']; 
        $merchant->added_by = Auth::user()->id ?? 1;
        $merchant->declined_by = null;

        // Save the updated merchant data
        $merchant->save();

        // Update the associated shareholders
        $this->updateShareholders($merchant, $data);

        return $merchant;
    }


    protected function updateShareholders(Merchant $merchant, array $data): void
    {
        // Delete existing shareholders (you could also update instead of deleting if needed)
        MerchantShareholder::where('merchant_id', $merchant->id)->delete();

        // Re-create the shareholders with the updated data
        $this->createShareholders($merchant, $data);
    }


    public function updateMerchantsSales(array $salesData, int $merchant_id)
    {
        // Delete all existing sales data for the merchant
        MerchantSale::where('merchant_id', $merchant_id)->delete();
    
        // Insert new sales data
        foreach ($salesData as $sale) {
            MerchantSale::create([
                'merchant_id' => $merchant_id,
                'min_transaction_amount' => $sale['minTransactionAmount'],
                'max_transaction_amount' => $sale['maxTransactionAmount'],
                'monthly_limit_amount' => $sale['monthlyLimitAmount'],
                'max_transaction_count' => $sale['maxTransactionCount'],
                'daily_limit_amount' => $sale['dailyLimitAmount'],
                'added_by' => Auth::user()->id ?? 1,
            ]);
        }

        MerchantService::where('merchant_id', $merchant_id)
        ->update(['approved_by' => null]);
    }
    


    public function updateMerchantsServices(array $servicesData, int $merchant_id)
    {
        foreach ($servicesData as $service_id => $serviceData) {
            // Validate if 'fields' key exists and is an array
            if (!isset($serviceData['fields']) || !is_array($serviceData['fields'])) {
                continue; // Skip invalid service data
            }
    
            // Delete existing data for the merchant_id and service_id
            MerchantService::where('merchant_id', $merchant_id)
                ->where('service_id', $service_id)
                ->delete();
    
            // Get the fields for the service
            $fields = $serviceData['fields'];
    
            // Iterate over each field and create new records
            foreach ($fields as $index => $fieldValue) {
                // Skip null or empty field values
                if (is_null($fieldValue) || $fieldValue === '') {
                    continue;
                }
    
                MerchantService::create([
                    'merchant_id' => $merchant_id,
                    'service_id' => $service_id,
                    'field_name' => 'Field ' . $index, // Name the fields dynamically
                    'field_value' => $fieldValue,
                    'added_by' => Auth::user()->id ?? 1, // Use authenticated user ID or fallback
                    'status' => true,
                ]);
            }
        }
    }
    

    public function deleteMerchants(int $merchant_id): void
    {
        Merchant::destroy($merchant_id);
    }


}
