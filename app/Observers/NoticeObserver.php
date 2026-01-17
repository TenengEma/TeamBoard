<?php

namespace App\Observers;

use App\Mail\NoticePublished;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NoticeObserver
{
    public function created(Notice $notice): void
    {
        // Notify all users when a high priority notice is created
        if ($notice->priority === 'high') {
            $users = User::where('id', '!=', $notice->author_id)->get();
            foreach ($users as $user) {
                Mail::to($user->email)->queue(new NoticePublished($notice));
            }
        }
    }

    public function updated(Notice $notice): void
    {
        // Log when notice is updated
        activity()
            ->performedOn($notice)
            ->withProperties(['old' => $notice->getOriginal(), 'new' => $notice->getAttributes()])
            ->log('updated');
    }
}
