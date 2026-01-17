@extends('layouts.app')

@section('title', 'Upload Document - TeamBoard')

@section('content')
<div style="max-width: 700px; margin: 0 auto;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #347486; margin-bottom: 10px;">
            <i class="fas fa-upload"></i> Upload Document
        </h1>
        <p style="color: #666;">Share a document with the team</p>
    </div>

    <div class="card">
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Document Title <span style="color: #BC4626;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Select File <span style="color: #BC4626;">*</span></label>
                <input type="file" name="document" class="form-control" required accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                <small style="color: #666; font-size: 12px;">
                    Max file size: 10MB. Allowed: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT
                </small>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fas fa-upload"></i> Upload Document
                </button>
                <a href="{{ route('documents.index') }}" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
