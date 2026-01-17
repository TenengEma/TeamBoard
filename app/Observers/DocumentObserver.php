<?php

namespace App\Observers;

use App\Mail\DocumentUploaded;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DocumentObserver
{
    public function created(Document $document): void
    {
        // Notify all users when a document is uploaded
        $users = User::where('id', '!=', $document->uploader_id)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new DocumentUploaded($document));
        }
    }

    public function deleted(Document $document): void
    {
        // Log when document is deleted
        activity()
            ->performedOn($document)
            ->withProperties(['document' => $document->title])
            ->log('deleted');
    }
}
