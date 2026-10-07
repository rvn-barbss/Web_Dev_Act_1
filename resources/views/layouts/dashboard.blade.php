<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Attendance Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>
<body>
<div class="dashboard-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
            </div>
            <h2>DevPortal</h2>
        </div>

        <nav class="sidebar-nav">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>Admin Logs</span>
                </a>
                <a href="{{ route('admin.scanner') }}" class="nav-item {{ request()->routeIs('admin.scanner') ? 'active' : '' }}">
                    <span>Attendance Console</span>
                </a>
                <a href="{{ route('admin.register') }}" class="nav-item {{ request()->routeIs('admin.register') ? 'active' : '' }}">
                    <span>Register Student</span>
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" class="nav-item active">
                    <span>My Attendance</span>
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}</div>
                <div class="user-info-mini">
                    <span class="name">{{ Auth::user()->first_name }}</span>
                    <span class="role">@<span>{{ Auth::user()->username }}</span></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="main-content">
        <header class="top-header">
            <div class="header-search">
                <input type="text" placeholder="Search system resources...">
            </div>
            <div class="header-actions">
                <div class="status-indicator">
                    <span class="pulse-dot"></span><span>System Online</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <div class="dashboard-body">
            @yield('content')
        </div>
    </main>
</div>
@stack('scripts')
</body>
</html>