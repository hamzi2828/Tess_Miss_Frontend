<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MerchantDocument;
use App\Models\User;
use App\Notifications\ExpiredDocumentNotification;
use Carbon\Carbon;

class CheckExpiredDocuments extends Command
{

    // php artisan check:expired-documents
    protected $signature = 'check:expired-documents';
    protected $description = 'Check for expired merchant documents and notify relevant users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch expired documents
        $expiredDocuments = MerchantDocument::where('date_expiry', '<', Carbon::now())->get();
    
        if ($expiredDocuments->isEmpty()) {
            $this->info('No expired documents found.');
            return;
        }

        // Retrieve users to be notified (example: stage 2 users)
        $stage2Users = User::whereHas('department', function ($query) {
            $query->where('stage', 2);
        })->get();

        // Notify each user about each expired document
        foreach ($expiredDocuments as $document) {
            foreach ($stage2Users as $user) {
                $user->notify(new ExpiredDocumentNotification($document));
            }
        }

        $this->info('Notifications sent for expired documents.');
    }
}
