<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceCompletedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('Pengajuan Anda Telah Selesai: ' . $this->service->event_name)
                   ->view('emails.completed-status');
    }
}