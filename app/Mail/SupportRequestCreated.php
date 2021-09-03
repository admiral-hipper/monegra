<?php

namespace App\Mail;

use App\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $supportRequestInstance;

    /**
     * Create a new message instance.
     *
     * @param SupportRequest $supportRequest
     */
    public function __construct(SupportRequest $supportRequest)
    {
        $this->supportRequestInstance = $supportRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.support')
            ->with([
                'name' => $this->supportRequestInstance->name,
                'email' => $this->supportRequestInstance->email,
                'text' => $this->supportRequestInstance->message,
            ]);
    }
}
