<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $htmlContent = view('emails.contactMail', ['order_data' => $this->contact])->render();

        return $this->view('emails.contactMail', ['order_data' => $this->contact])
            ->subject('Wycra Order Confirmation')
            ->attachData($htmlContent, 'order_confirmation.html', [
                'mime' => 'text/html',
            ]);
    }
}
