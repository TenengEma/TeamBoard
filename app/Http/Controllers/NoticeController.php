<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Notice::with('author');

        // Priority filter
        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content_body', 'like', "%{$search}%");
            });
        }

        $notices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_body' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['author_id'] = auth()->id();

        Notice::create($validated);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        $notice->load('author');
        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        // Check if user is author or admin
        if (auth()->id() !== $notice->author_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        // Check if user is author or admin
        if (auth()->id() !== $notice->author_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_body' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $notice->update($validated);

        return redirect()->route('notices.show', $notice)->with('success', 'Notice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        // Check if user is author or admin
        if (auth()->id() !== $notice->author_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $notice->delete();

        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully!');
    }
}
