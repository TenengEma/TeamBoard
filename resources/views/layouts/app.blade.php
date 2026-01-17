<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TeamBoard - Intranet Management')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Decorative background shapes -->
    <div class="bg-shapes"></div>
    <!-- Sidebar -->
    <aside class="sidebar" data-animate="slide-in-left">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-logo">
                <i class="fas fa-users-cog"></i>
                TeamBoard
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home sidebar-menu-icon"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="sidebar-menu-item">
                <a href="{{ route('employees.index') }}" class="sidebar-menu-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <i class="fas fa-users sidebar-menu-icon"></i>
                    Employees
                </a>
            </li>
            
            <li class="sidebar-menu-item">
                <a href="{{ route('notices.index') }}" class="sidebar-menu-link {{ request()->routeIs('notices.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn sidebar-menu-icon"></i>
                    Notice Board
                </a>
            </li>
            
            <li class="sidebar-menu-item">
                <a href="{{ route('documents.index') }}" class="sidebar-menu-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open sidebar-menu-icon"></i>
                    Documents
                </a>
            </li>
            
            @if(auth()->user()->isAdmin())
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <i class="fas fa-cog sidebar-menu-icon"></i>
                    Admin Panel
                </a>
            </li>
            @endif
        </ul>
    </aside>

    <!-- Navbar -->
    <nav class="navbar" data-animate="slide-in-down">
        <button onclick="toggleSidebar()" class="btn btn-primary" style="display: none;">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="navbar-search">
            <input type="text" placeholder="Search..." id="global-search">
        </div>
        
        <div class="navbar-actions">
            <div class="navbar-user" onclick="toggleDropdown('user-dropdown')">
                <div class="navbar-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="navbar-user-info">
                    <div class="navbar-user-name">{{ auth()->user()->name }}</div>
                    <div class="navbar-user-role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                <i class="fas fa-chevron-down"></i>
            </div>
            
            <!-- User Dropdown -->
            <div id="user-dropdown" class="hidden" style="position: absolute; top: 60px; right: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; min-width: 150px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content" data-animate="fade-up" class="fade-fast">
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success" data-animate="fade-in">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error" data-animate="fade-in">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error" data-animate="fade-in">
            <i class="fas fa-exclamation-circle"></i>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
