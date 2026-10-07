<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Attendance Portal</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>
<body>
<div class="dashboard-layout">
    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                </div>
                <h2>DevPortal</h2>
            </div>

            <nav class="sidebar-nav">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="14" width="7" height="7" rx="1"></rect><rect x="3" y="14" width="7" height="7" rx="1"></rect></svg>
                        <span>Admin Logs</span>
                    </a>
                    <a href="{{ route('admin.scanner') }}" class="nav-item {{ request()->routeIs('admin.scanner') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Attendance Console</span>
                    </a>
                    <a href="{{ route('admin.register') }}" class="nav-item {{ request()->routeIs('admin.register') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        <span>Register Student</span>
                    </a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span>My Attendance</span>
                    </a>
                @endif
            </nav>
        </div>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}</div>
                <div class="user-info-mini">
                    <span class="name">{{ Auth::user()->first_name }}</span>
                    <span class="role">{{ Auth::user()->isAdmin() ? 'Administrator' : 'Student' }}</span>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div class="header-search">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" placeholder="Search system records...">
            </div>
            <div class="header-actions">
                <div class="status-indicator">
                    <span class="pulse-dot"></span><span>System Online</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Logout</span>
                    </button>
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