<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantDocument;
use App\Models\MerchantSale;
use App\Models\MerchantService;
use App\Models\User;
use App\Notifications\MerchantActivityNotification;

class NotificationService
{

    public function storeMerchantsKYC($merchant)
    {
        // Retrieve the user who added the merchant
        $addedByUser = User::find($merchant->added_by);
        $addedByUserName = $addedByUser ? $addedByUser->name : auth()->user()->name;
        $notificationMessage = "A new KYC has been saved";
        $role = 'supervisor';
        $stage = 1;
        $this->approveEntity($merchant, 'store', $stage, $notificationMessage, $role, $addedByUserName);
    }

    public function storeMerchantsDocuments($merchantId)
    {
        // Fetch merchant and related data
        $merchant = Merchant::with(['documents', 'sales', 'services', 'shareholders'])->where('id', $merchantId)->first();

        if (!$merchant) {
            return back()->with('error', 'Merchant documents not found.');
        }
        $firstDocument = $merchant->documents->first();
        $addedByUser = $firstDocument ? User::find($firstDocument->added_by) : null;
        $addedByUserName = $addedByUser ? $addedByUser->name : auth()->user()->name;
        $notificationMessage = 'New documents have been uploaded.';
        $role = 'supervisor';
        $stage = 2;
        $this->approveEntity($merchant, 'store', $stage, $notificationMessage, $role, $addedByUserName);
    }

    public function storeMerchantsSales($merchantId)
    {
        // Fetch merchant and related data
        $merchant = Merchant::with(['documents', 'sales', 'services', 'shareholders'])->where('id', $merchantId)->first();

        if (!$merchant) {
            return back()->with('error', 'Merchant sales not found.');
        }
        $firstSale = $merchant->sales->first();
        $addedByUser = $firstSale ? User::find($firstSale->added_by) : null;
        $addedByUserName = $addedByUser ? $addedByUser->name : auth()->user()->name;


        $notificationMessage = 'New sales have been saved.';
        $role = 'supervisor';
        $stage = 3;

        $this->approveEntity($merchant, 'store', $stage, $notificationMessage, $role, $addedByUserName);
    }

    public function storeMerchantsServices($merchantId)
    {
        // Fetch merchant and related data
        $merchant = Merchant::with(['documents', 'sales', 'services', 'shareholders'])->where('id', $merchantId)->first();

        if (!$merchant) {
            return back()->with('error', 'Merchant services not found.');
        }
        $firstService = $merchant->services->first();
        $addedByUser = $firstService ? User::find($firstService->added_by) : null;
        $addedByUserName = $addedByUser ? $addedByUser->name : auth()->user()->name;
        $notificationMessage = 'New services have been saved.';
        $role = 'supervisor';
        $stage = 4;
        $this->approveEntity($merchant, 'store', $stage, $notificationMessage, $role, $addedByUserName);
    }





    // Approve KYC

    public function approveKYC($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $merchant->approved_by = auth()->user()->id;
        $merchant->declined_by = null;
        $merchant->save();
        $activityType = 'approve';
        $notificationMessage = "A new KYC has been approved";
        $role = 'user';
        $stage = 2;
        $approvedByUserName = auth()->user()->name;
        $this->approveEntity($merchant, $activityType, $stage, $notificationMessage, $role, $approvedByUserName);
    }



    // Approve Documents
    public function approveMerchantsDocuments($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $documents = MerchantDocument::where('merchant_id', $merchantId)->get();

        // Loop through each document to update the approval
        foreach ($documents as $document) {
            $document->approved_by = auth()->user()->id;
            $document->declined_by = null;
            $document->save();
        }
        $activityType = 'approve';
        $notificationMessage = "Merchant documents have been approved";
        $role = 'user';
        $stage = 3;
        $approvedByUserName = auth()->user()->name;

            $this->approveEntity($merchant, $activityType, $stage, $notificationMessage, $role, $approvedByUserName);

    }


    // Approve Sales
    public function approveMerchantsSales($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $sales = MerchantSale::where('merchant_id', $merchantId)->get();

        foreach ($sales as $sale) {
            $sale->approved_by = auth()->user()->id;
            $sale->declined_by = null;
            $sale->save();
        }
        $activityType = 'approve';
        $notificationMessage = "Merchant Sales have been approved";
        $role = 'user';
        $stage = 4;
        $approvedByUserName = auth()->user()->name;
        $this->approveEntity($merchant, $activityType, $stage, $notificationMessage, $role, $approvedByUserName);
    }

    // Approve Services
    public function approveMerchantsServices($merchantId)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $services = MerchantService::where('merchant_id', $merchantId)->get();
        foreach ($services as $service) {
            $service->approved_by = auth()->user()->id;
            $service->declined_by = null;
            $service->save();
        }
        $activityType = 'approve';
        $notificationMessage = "Merchant services have been approved, completing the process";
        $role = 'user';
        $stage = 4;
        $approvedByUserName = auth()->user()->name;
        $this->approveEntity($merchant, $activityType, $stage, $notificationMessage, $role, $approvedByUserName);

    }

    // Common Approval Logic
    private function approveEntity($entity, $type, $stage, $notificationMessage, $role, $UserName = null)
    {

        $user = User::where('role', $role)
            ->whereHas('department', function ($query) use ($stage) {
                $query->where('stage', $stage);
            })->get();


        foreach ($user as $user) {

            $user->notify(new MerchantActivityNotification($type, $entity, $UserName, $notificationMessage));
        }
    }


    
    public function declineKYC($merchantId, $declineNotes )
    {
        $merchant = Merchant::findOrFail($merchantId);
        $merchant->declined_by = auth()->user()->id;
        $merchant->save();

        $activityType = 'decline';
        $notificationMessage = "The KYC has been declined with the following notes: " . $declineNotes;
        $role = 'user';
        $stage = 1;
        $declinedByUserName = auth()->user()->name;
    

        $this->declineEntity($merchant, $activityType, $stage, $notificationMessage, $role, $declinedByUserName);
    }

    // Decline Documents
    public function declineMerchantsDocuments($merchantId, $declineNotes)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $documents = MerchantDocument::where('merchant_id', $merchantId)->get();

        foreach ($documents as $document) {
            $document->declined_by = auth()->user()->id;
            $document->decline_notes = $declineNotes;
            $document->approved_by = null;
            $document->save();
        }

        $activityType = 'decline';
        $notificationMessage = "Merchant documents have been declined with the following notes: " . $declineNotes;
        $role = 'user';
        $stage = 2;
        $declinedByUserName = auth()->user()->name;

        $this->declineEntity($merchant, $activityType, $stage, $notificationMessage, $role, $declinedByUserName);
    }

    // Decline Sales
    public function declineMerchantsSales($merchantId, $declineNotes)
    {
        $merchant = Merchant::findOrFail($merchantId);
        $sales = MerchantSale::where('merchant_id', $merchantId)->get();

        foreach ($sales as $sale) {
            $sale->declined_by = auth()->user()->id;
            $sale->decline_notes = $declineNotes;
            $sale->approved_by = null;
            $sale->save();
        }

        $activityType = 'decline';
        $notificationMessage = "Merchant sales have been declined with the following notes: " . $declineNotes;
        $role = 'user';
        $stage = 3;
        $declinedByUserName = auth()->user()->name;

        $this->declineEntity($merchant, $activityType, $stage, $notificationMessage, $role, $declinedByUserName);
    }

    // Decline Services
    public function declineMerchantsServices($merchantId, $declineNotes)
    {

        $merchant = Merchant::findOrFail($merchantId);
        $services = MerchantService::where('merchant_id', $merchantId)->get();

        foreach ($services as $service) {
            $service->declined_by = auth()->user()->id;
            $service->decline_notes = $declineNotes;
            $service->approved_by = null;
            $service->save();
        }

        $activityType = 'decline';
        $notificationMessage = "Merchant services have been declined with the following notes: " . $declineNotes;
        $role = 'user';
        $stage = 4;
        $declinedByUserName = auth()->user()->name;

        $this->declineEntity($merchant, $activityType, $stage, $notificationMessage, $role, $declinedByUserName);
    }

    // Common Decline Logic
    private function declineEntity($entity, $type, $stage, $notificationMessage, $role, $userName = null)
    {
        $users = User::where('role', $role)
            ->whereHas('department', function ($query) use ($stage) {
                $query->where('stage', $stage);
            })->get();

        foreach ($users as $user) {
            $user->notify(new MerchantActivityNotification($type, $entity, $userName, $notificationMessage));
        }
    }

}
