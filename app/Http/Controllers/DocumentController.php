<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Document::with('uploader');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('filename', 'like', "%{$search}%");
            });
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240',
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $filepath = $file->store('documents', 'public');

            Document::create([
                'title' => $validated['title'],
                'filename' => $filename,
                'filepath' => $filepath,
                'uploader_id' => auth()->id(),
            ]);
        }

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully!');
    }

    /**
     * Download the specified resource.
     */
    public function download(Document $document)
    {
        return Storage::disk('public')->download($document->filepath, $document->filename);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $document->load('uploader');
        return view('documents.show', compact('document'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        // Only uploader or admin can delete
        if (auth()->id() !== $document->uploader_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the file
        if ($document->filepath) {
            Storage::disk('public')->delete($document->filepath);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        // Only uploader or admin can edit
        if (auth()->id() !== $document->uploader_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Only uploader or admin can update
        if (auth()->id() !== $document->uploader_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $document->update($validated);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }
}
