<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ConfigurateurEmail extends Mailable
{
    public function __construct(public array $pierres) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Nouvelle configuration de pierres');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.configurateur');
    }
}
