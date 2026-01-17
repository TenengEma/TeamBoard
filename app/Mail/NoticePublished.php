<?php

namespace App\Mail;

use App\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NoticePublished extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Notice $notice)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Notice: ' . $this->notice->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notice-published',
            with: [
                'notice' => $this->notice,
                'author' => $this->notice->author->name,
                'url' => route('notices.show', $this->notice),
            ],
        );
    }
}
