<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;
    public $attachment;

    public function __construct($subject, $body, $attachments = [])
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->attachment = is_array($attachments) ? $attachments : [];
    }

    public function build()
    {
        $email = $this->view('mail.mail')
                      ->subject($this->subject)
                      ->with(['body' => $this->body]);

        if (!empty($this->attachment)) {
            foreach ($this->attachment as $attachment) {
                if ($attachment instanceof UploadedFile) {
                    $email->attach(
                        $attachment->getRealPath(),
                        [
                            'as' => $attachment->getClientOriginalName(),
                            'mime' => $attachment->getMimeType(),
                        ]
                    );
                }
            }
        }

        return $email;
    }
}