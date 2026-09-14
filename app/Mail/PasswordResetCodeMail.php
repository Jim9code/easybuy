<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public string $email;
    public ?User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(string $code, string $email, ?User $user = null)
    {
        $this->code = $code;
        $this->email = $email;
        $this->user = $user ?? User::where('email', $email)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "EasyBuy Security: Your Password Reset Code is {$this->code}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password-reset',
            with: [
                'code' => $this->code,
                'email' => $this->email,
                'user' => $this->user,
                'expiresMinutes' => 15,
                'resetUrl' => url('/forgot-password?email=' . urlencode($this->email)),
            ],
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
