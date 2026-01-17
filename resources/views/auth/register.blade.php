<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - TeamBoard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: radial-gradient(1200px circle at 10% 10%, #f0f7fa 0%, #eaf2f6 35%, #f5f7fa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .auth-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            max-width: 960px;
            width: 100%;
            display: flex;
        }

        .auth-left {
            flex: 1;
            padding: 60px 40px;
            background: linear-gradient(135deg, #DFA44D 0%, #c89340 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .auth-left h1 { font-size: 32px; margin-bottom: 20px; }
        .auth-left p { font-size: 16px; opacity: 0.9; }

        .auth-right { flex: 1; padding: 60px 40px; }
        .auth-header { text-align: center; margin-bottom: 40px; }
        .auth-header h2 { font-size: 28px; color: #347486; margin-bottom: 10px; }
        .auth-header p { color: #666; }

        .form-group[data-animate] { transition-delay: 80ms; }
        .form-group[data-animate]:nth-child(2) { transition-delay: 160ms; }
        .form-group[data-animate]:nth-child(3) { transition-delay: 240ms; }
        .form-group[data-animate]:nth-child(4) { transition-delay: 320ms; }
    </style>
</head>
<body>
    <div class="bg-shapes"></div>
    <div class="auth-container hover-raise" data-animate="fade-up">
        <div class="auth-left" data-animate="slide-in-left">
            <div class="lottie-container" data-lottie="https://assets4.lottiefiles.com/packages/lf20_u4yrau.json" data-loop="true" data-autoplay="true" style="width: 220px; height: 220px; margin-bottom: 30px;"></div>
            <h1><i class="fas fa-user-plus"></i> Join TeamBoard</h1>
            <p>Create your account and get started</p>
        </div>
        
        <div class="auth-right glass-card" data-animate="fade-up">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Fill in your details to register</p>
            </div>

            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" data-animate="fade-in" class="fade-fast">
                @csrf
                
                <div class="form-group" data-animate="fade-in">
                    <label class="form-label">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                </div>
                
                <div class="form-group" data-animate="fade-in">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group" data-animate="fade-in">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-group" data-animate="fade-in">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-accent btn-shimmer" style="width: 100%; padding: 12px; font-size: 16px;">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
            
            <div style="text-align: center; margin-top: 30px; padding-top: 30px; border-top: 1px solid #e0e0e0;" data-animate="fade-in">
                <p style="color: #666;">Already have an account? <a href="{{ route('login') }}" style="color: #347486; font-weight: 600; text-decoration: none;">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
