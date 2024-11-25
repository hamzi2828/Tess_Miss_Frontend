<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MerchantActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $activityType;
    protected $merchant;
    protected $UserName;
    protected $notificationMessage;

    /**
     * Create a new notification instance.
     *
     * @param string $activityType
     * @param \App\Models\Merchant $merchant
     * @param string $UserName
     */
    public function __construct(string $activityType, $merchant, $UserName, $notificationMessage)
    {
        $this->activityType = $activityType;
        $this->merchant = $merchant;
        $this->UserName = $UserName;
        $this->notificationMessage = $notificationMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification (for database storage).
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'activity_type' => $this->activityType,
            'merchant_id' => $this->merchant->id ?? null, 
            'added_by' => $this->UserName, 
            'message' =>  $this->notificationMessage,
        ];
    }
}