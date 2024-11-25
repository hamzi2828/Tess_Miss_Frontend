<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\MerchantDocument;

class ExpiredDocumentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $document;

    /**
     * Create a new notification instance.
     *
     * @param MerchantDocument $document
     */
    public function __construct(MerchantDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database']; // Only stores notification in the database
    }

    /**
     * Get the array representation of the notification (for database storage).
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'The document "' . $this->document->title . '" has expired.',
            'document_id' => $this->document->id,
            'merchant_id' => $this->document->merchant_id,
            'expiry_date' => $this->document->date_expiry,
        ];
    }
}
