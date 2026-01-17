<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Document Uploaded</title>
    <style>
        body { font-family: 'Inter', sans-serif; color: #333; background-color: #f5f7fa; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #347486 0%, #2a5d6b 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { padding: 30px 20px; }
        .document-title { font-size: 24px; font-weight: 600; color: #347486; margin-bottom: 10px; }
        .document-meta { color: #666; font-size: 14px; margin-bottom: 20px; }
        .document-info { background-color: #f5f7fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .cta-button { display: inline-block; background-color: #347486; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; border-top: 1px solid #e0e0e0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📄 New Document Uploaded</h1>
        </div>
        <div class="content">
            <div class="document-title">{{ $document->title }}</div>
            <div class="document-meta">Uploaded by {{ $uploader }}</div>
            <div class="document-info">
                @if($document->description)
                <p><strong>Description:</strong></p>
                <p>{{ $document->description }}</p>
                @endif
            </div>
            <a href="{{ $url }}" class="cta-button">View Document</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} TeamBoard. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
