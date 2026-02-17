<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    public $application;

    /**
     * Create a new notification instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusMessages = $this->getStatusMessages();

        return (new MailMessage)
            ->subject(__('notifications.status_update_subject').config('app.name'))
            ->view('emails.application-status-updated', [
                'application' => $this->application,
                'user' => $notifiable,
                'statusTitle' => $statusMessages['title'],
                'statusMessage' => $statusMessages['message'],
                'statusColor' => $statusMessages['color'],
                'showComment' => $this->application->status === 'require_resubmit',
                'adminComment' => $this->application->admin_resubmission_comment,
            ]);
    }

    /**
     * Get status-specific messages and styling
     */
    private function getStatusMessages(): array
    {
        return match ($this->application->status) {
            'under_review' => [
                'title' => __('notifications.under_review_title'),
                'message' => __('notifications.under_review_message'),
                'color' => '#f59e0b',
            ],
            'accepted' => [
                'title' => __('notifications.accepted_title'),
                'message' => __('notifications.accepted_message'),
                'color' => '#10b981',
            ],
            'rejected' => [
                'title' => __('notifications.rejected_title'),
                'message' => __('notifications.rejected_message'),
                'color' => '#ef4444',
            ],
            'require_resubmit' => [
                'title' => __('notifications.require_resubmit_title'),
                'message' => __('notifications.require_resubmit_message'),
                'color' => '#f59e0b',
            ],
        };
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'status' => $this->application->status,
            'message' => $this->getStatusMessages()['message'],
        ];
    }
}
