<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $query = Notice::with('author');

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        return response()->json(
            $query->latest()->paginate($request->per_page ?? 15)
        );
    }

    public function show(Notice $notice)
    {
        return response()->json($notice->load('author'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['author_id'] = auth()->id();
        $notice = Notice::create($validated);

        return response()->json($notice->load('author'), 201);
    }

    public function update(Request $request, Notice $notice)
    {
        $this->authorize('update', $notice);

        $validated = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'priority' => 'in:low,medium,high',
        ]);

        $notice->update($validated);

        return response()->json($notice->load('author'));
    }

    public function destroy(Notice $notice)
    {
        $this->authorize('delete', $notice);
        $notice->delete();
        return response()->json(null, 204);
    }

    public function byPriority($priority)
    {
        return response()->json(
            Notice::where('priority', $priority)
                   ->with('author')
                   ->latest()
                   ->limit(10)
                   ->get()
        );
    }

    public function publish(Request $request, Notice $notice)
    {
        $this->authorize('update', $notice);
        $notice->update(['published_at' => now()]);
        return response()->json(['message' => 'Notice published.', 'notice' => $notice->load('author')]);
    }
}
