<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServicePendingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('Pengajuan Anda Sedang Diproses: ' . $this->service->event_name)
                   ->view('emails.pending-status');
    }
}