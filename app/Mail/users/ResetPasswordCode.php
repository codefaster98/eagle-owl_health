<?php

namespace App\Mail\users;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $fname;
    public $email;
    public  $code;

    public function __construct($code,$fname, $email) {
        $this->fname = $fname;
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Code',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // view("")
        return new Content(
            // htmlString: "Youd Verfy Code <br>" . $this->code
            view: 'mails.verifyForget',
            with: [
                "code" => $this->code,
                'name' => $this->fname,
                'email' => $this->email,
                "code_array" => str_split($this->code)
            ]
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
