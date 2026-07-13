<?php
// app/Mail/BlastEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlastEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $variables;
    public $subject;

    public function __construct($content, $variables = [], $subject = 'Email dari UMN Medical Center')
    {
        $this->content = $content;
        $this->variables = $variables;
        $this->subject = $subject;
    }

    public function build()
    {
        // Process variables in content
        $processedContent = $this->content;
        
        foreach ($this->variables as $key => $value) {
            $placeholder = '(' . $key . ')';
            $processedContent = str_replace($placeholder, $value, $processedContent);
        }

        // Process variables in subject juga
        $processedSubject = $this->subject;
        foreach ($this->variables as $key => $value) {
            $placeholder = '(' . $key . ')';
            $processedSubject = str_replace($placeholder, $value, $processedSubject);
        }

        return $this->subject($processedSubject)
                    ->html(nl2br($processedContent)); // Convert newlines to <br>
    }
}