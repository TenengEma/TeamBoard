<?php

namespace App\Mail;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentUploaded extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Document $document)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Document Uploaded: ' . $this->document->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.document-uploaded',
            with: [
                'document' => $this->document,
                'uploader' => $this->document->uploader->name,
                'url' => route('documents.show', $this->document),
            ],
        );
    }
}
