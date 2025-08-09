<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceCanceledNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $cancelReason;

    public function __construct($service, $cancelReason = null)
    {
        $this->service = $service;
        $this->cancelReason = $cancelReason;
    }

    public function build()
    {
        return $this->subject('Pengajuan Anda Dibatalkan: ' . $this->service->event_name)
                   ->view('emails.canceled-status', [
                       'service' => $this->service,
                       'cancelReason' => $this->cancelReason
                   ]);
    }
}