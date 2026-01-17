<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notice</title>
    <style>
        body { font-family: 'Inter', sans-serif; color: #333; background-color: #f5f7fa; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #347486 0%, #2a5d6b 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { padding: 30px 20px; }
        .notice-title { font-size: 24px; font-weight: 600; color: #347486; margin-bottom: 10px; }
        .notice-meta { color: #666; font-size: 14px; margin-bottom: 20px; }
        .notice-content { color: #333; line-height: 1.6; margin-bottom: 20px; }
        .cta-button { display: inline-block; background-color: #347486; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; border-top: 1px solid #e0e0e0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📢 New Notice Published</h1>
        </div>
        <div class="content">
            <div class="notice-title">{{ $notice->title }}</div>
            <div class="notice-meta">Posted by {{ $author }} • Priority: <strong>{{ ucfirst($notice->priority) }}</strong></div>
            <div class="notice-content">
                {{ Str::limit($notice->content, 500) }}
            </div>
            <a href="{{ $url }}" class="cta-button">View Full Notice</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} TeamBoard. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
