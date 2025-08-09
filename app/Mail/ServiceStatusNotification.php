<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
    public function build()
    {
        return $this->subject('Status Update for Your Service Request: ' . $this->service->event_name)
                    ->view('emails.service-status');
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Service Status Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.service-status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
