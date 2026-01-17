<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Document;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_employees' => Employee::count(),
            'total_notices' => Notice::count(),
            'total_documents' => Document::count(),
            'total_users' => User::count(),
        ];

        $recent_notices = Notice::with('author')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recent_documents = Document::with('uploader')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_notices', 'recent_documents'));
    }
}
