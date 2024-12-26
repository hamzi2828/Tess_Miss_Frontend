<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\MerchantDocument;
use App\Models\MerchantSale;
use App\Models\MerchantShareholder;
use App\Models\MerchantService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; // Make sure this line is here
use App\Notifications\MerchantActivityNotification;
use Illuminate\Support\Facades\Log;


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
            $merchant->added_by = Auth::user()->id;
            $merchant->status = 'screening';
            $merchant->save();

            // Save operational countries
            if (isset($data['operating_countries'])) {
                $merchant->operating_countries()->sync($data['operating_countries']);
            }

            // Handle Shareholders
            $this->createShareholders($merchant, $data);

            return $merchant;
        }





    protected function createShareholders(Merchant $merchant, array $data): void
    {
        $firstNames = $data['shareholderFirstName'];
        $middleNames = $data['shareholderMiddleName'] ?? [];
        $lastNames = $data['shareholderLastName'];
        $dobs = $data['shareholderDOB'];
        $nationalities = $data['shareholderNationality'];
        $qids = $data['shareholderID'];
        
        foreach ($firstNames as $index => $firstName) {
            $shareholder = new MerchantShareholder();
            $shareholder->merchant_id = $merchant->id;
            $shareholder->first_name = $firstName;
            $shareholder->middle_name = $middleNames[$index] ?? null;
            $shareholder->last_name = $lastNames[$index];
            $shareholder->dob = $dobs[$index];
            $shareholder->country_id = $nationalities[$index];
            $shareholder->qid = $qids[$index] ?? null;
            $shareholder->added_by = Auth::user()->id;
            $shareholder->status = 'active';
            $shareholder->title = $firstName . ' ' . $lastNames[$index];

            // Perform sanctions check
            $sanctionsResult = $this->checkSanctions(
                $firstName,
                $middleNames[$index] ?? null,
                $lastNames[$index],
                $dobs[$index],
                $nationalities[$index]
            );
        // Process the sanctions result
            $processedResult = $this->processSanctionsResult($sanctionsResult);
            // Store sanctions check results
            $shareholder->sanctions_check_status = $processedResult['status'];
            $shareholder->sanctions_check_date = now();
            $shareholder->sanctions_score = $processedResult['score'];
            $shareholder->has_sanctions_match = $processedResult['hasMatch'];
            $shareholder->sanctions_check_result = $processedResult['matchDetails'];

            $shareholder->save();
        }
    }

    protected function checkSanctions(string $firstName, ?string $middleName, string $lastName, string $dob, string $nationality): array
    {
        $fullName = trim($firstName . ' ' . ($middleName ?? '') . ' ' . $lastName);
        $api_key = "ddb3cfd0f8f4541962ee37f046ec96cd";

        try {
            $query = [
                "queries" => [
                    "q1" => [
                        "weights" => [
                            "name_literal_match" => [0.0],
                            "name_soundex_match" => [1.0]
                        ],
                        "schema" => "Person",
                        "properties" => [
                            "name" => [$fullName],
                            "birthDate" => [date('Y', strtotime($dob))],
                            "nationality" => [$nationality]
                        ]
                    ]
                ]
            ];

            $response = Http::withHeaders([
                'Authorization' => 'ApiKey ' . $api_key,
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.opensanctions.org/match/default?algorithm=best&fuzzy=false',
                $query
            );

            // Log the request for debugging
            Log::info('Sanctions API request made', [
                'name' => $fullName,
                'status_code' => $response->status(),
                'response_length' => strlen($response->body())
            ]);

            if (!$response->successful()) {
                return [
                    'status' => 'error',
                    'message' => 'API request failed: ' . $response->body(),
                    'data' => null
                ];
            }

            $result = $response->json();

            return [
                'status' => 'success',
                'message' => 'Sanctions check completed',
                'data' => $result['responses']['q1'] ?? null,
                'has_matches' => !empty($result['responses']['q1']['matches'])
            ];

        } catch (\Exception $e) {
            Log::error('Exception during sanctions check', [
                'error' => $e->getMessage(),
                'name' => $fullName,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'status' => 'error',
                'message' => 'Sanctions check failed: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
    protected function processSanctionsResult(array $sanctionsResult): array
    {
        // Initialize default response
        $processedResult = [
            'status' => 'error',
            'score' => 0,
            'hasMatch' => false,
            'matchDetails' => null
        ];

        // Check if we have a successful response
        if ($sanctionsResult['status'] === 'success' &&
            isset($sanctionsResult['data']['results']) &&
            is_array($sanctionsResult['data']['results'])) {

            // Find the result with maximum score
            $maxScore = 0;
            $bestMatch = null;

            foreach ($sanctionsResult['data']['results'] as $result) {
                $currentScore = $result['score'] ?? 0;
                if ($currentScore > $maxScore) {
                    $maxScore = $currentScore;
                    $bestMatch = $result;
                }
            }

            // If we found a match, prepare the processed result
            if ($bestMatch) {
                $hasMatch = $maxScore >= 0.9; // You can adjust this threshold

                $processedResult = [
                    'status' => 'success',
                    'score' => $maxScore,
                    'hasMatch' => $hasMatch,
                    'matchDetails' => [
                        'id' => $bestMatch['id'] ?? null,
                        'caption' => $bestMatch['caption'] ?? null,
                        'schema' => $bestMatch['schema'] ?? null,
                        'first_seen' => $bestMatch['first_seen'] ?? null,
                        'last_seen' => $bestMatch['last_seen'] ?? null,
                        'last_change' => $bestMatch['last_change'] ?? null,
                        'score' => $maxScore,
                        'match' => $hasMatch,
                        'properties' => $bestMatch['properties'] ?? null,
                        'datasets' => $bestMatch['datasets'] ?? null
                    ]
                ];
            }
        }

        return $processedResult;
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
        $merchant->update([
            'merchant_name' => $data['merchant_name'],
            'merchant_name_ar' => $data['merchant_arabic_name'],
            'comm_reg_no' => $data['company_registration'],
            'address' => $data['company_address'],
            'merchant_mobile' => $data['mobile_number'],
            'merchant_category' => $data['company_activities'],
            'merchant_landline' => $data['landline_number'],
            'merchant_url' => $data['website'],
            'merchant_email' => $data['email'],
            'website_month_visit' => $data['monthly_website_visitors'],
            'contact_person_name' => $data['key_point_of_contact'],
            'website_month_active' => $data['monthly_active_users'],
            'contact_person_mobile' => $data['key_point_mobile'],
            'website_month_volume' => $data['monthly_avg_volume'],
            'merchant_previous_bank' => $data['existing_banking_partner'],
            'website_month_transaction' => $data['monthly_avg_transactions'],
            'merchant_date_incorp' => $data['date_of_incorporation'],
            'added_by' => Auth::user()->id ?? 1,
            'declined_by' => null,
        ]);

        // Update the associated shareholders
        $this->updateShareholders($merchant, $data);

        // Update operating countries
        if (isset($data['operating_countries']) && is_array($data['operating_countries'])) {
            $merchant->operating_countries()->sync($data['operating_countries']);
        }

        return $merchant;
    }

    protected function updateShareholders(Merchant $merchant, array $data): void
    {
        // Use transaction to ensure data consistency
        DB::transaction(function () use ($merchant, $data) {
            // Delete existing shareholders
            $merchant->shareholders()->delete();

            // Re-create the shareholders with the updated data
            $this->createShareholders($merchant, $data);
        });
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
