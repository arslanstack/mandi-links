<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    public $name, $phone_no, $message_body;

    public function __construct($name, $phone_no, $message_body)
    {
        $this->name = $name;
        $this->phone_no = $phone_no;
        $this->message_body = $message_body;
    }

    public function build()
    {
        return $this->subject('A User Contacted You For Support')
            ->view('emails.contact')
            ->with([
                'name' => $this->name,
                'phone_no' => $this->phone_no,
                'message_body' => $this->message_body,
            ]);
    }
}
