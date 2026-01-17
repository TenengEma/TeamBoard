<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notice;
use App\Models\User;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $notices = [
            [
                'title' => 'Welcome to TeamBoard',
                'content_body' => 'We are excited to launch our new intranet management system. This platform will help us stay connected, share important information, and collaborate more effectively. Please explore all the features and reach out if you have any questions.',
                'author_id' => $admin->id,
                'priority' => 'high',
            ],
            [
                'title' => 'Office Maintenance Schedule',
                'content_body' => 'Please note that office maintenance will be conducted this weekend. The building will be closed on Saturday and Sunday. Regular operations will resume on Monday.',
                'author_id' => $admin->id,
                'priority' => 'medium',
            ],
            [
                'title' => 'Team Building Event',
                'content_body' => 'Join us for our quarterly team building event next Friday at 3 PM. We will have various activities and refreshments. Please RSVP by Wednesday.',
                'author_id' => $admin->id,
                'priority' => 'low',
            ],
        ];

        foreach ($notices as $notice) {
            Notice::create($notice);
        }
    }
}
