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
            ->subject('Application Status Update - EduAdmit')
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
                'title' => 'Application Under Review',
                'message' => 'Your application is currently being reviewed by our admissions team. We will notify you once a decision has been made.',
                'color' => '#f59e0b',
            ],
            'accepted' => [
                'title' => 'Congratulations! Application Accepted',
                'message' => 'We are pleased to inform you that your application has been accepted. Welcome to our program!',
                'color' => '#10b981',
            ],
            'rejected' => [
                'title' => 'Application Decision',
                'message' => 'After careful consideration, we regret to inform you that your application was not accepted at this time.',
                'color' => '#ef4444',
            ],
            'require_resubmit' => [
                'title' => 'Application Requires Resubmission',
                'message' => 'Your application requires some additional information or corrections. Please review the comments below and resubmit your application.',
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
