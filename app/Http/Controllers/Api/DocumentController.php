<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('uploader');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        return response()->json(
            $query->latest()->paginate($request->per_page ?? 15)
        );
    }

    public function show(Document $document)
    {
        return response()->json($document->load('uploader'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $path;
        }

        $validated['uploader_id'] = auth()->id();
        $document = Document::create($validated);

        return response()->json($document->load('uploader'), 201);
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();
        return response()->json(null, 204);
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        return Storage::disk('public')->download($document->file_path, $document->title);
    }
}
