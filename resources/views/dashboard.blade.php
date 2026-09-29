<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Control Panel</title>
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
                <svg viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
            </div>
            <h2>DevPortal</h2>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="nav-item active">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Profile Details</span>
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <span>Security</span>
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                </svg>
                <span>Database Info</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->first_name, 0, 1)) }}
                </div>
                <div class="user-info-mini">
                    <span class="name">{{ $user->first_name }}</span>
                    <span class="role">@<span>{{ $user->username }}</span></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="main-content">
        <!-- TOP HEADER -->
        <header class="top-header">
            <div class="header-search">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Search system resources...">
            </div>

            <div class="header-actions">
                <div class="status-indicator">
                    <span class="pulse-dot"></span>
                    <span>System Online</span>
                </div>

                <!-- SECURE LOGOUT FORM -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- DASHBOARD BODY -->
        <div class="dashboard-body">
            <!-- HERO CARD -->
            <div class="hero-banner">
                <div class="hero-text">
                    <h1>Welcome back, {{ $user->first_name }}!</h1>
                    <p>You are authenticated into your secure Laravel session. Your profile data and relational records are managed via XAMPP MySQL.</p>
                </div>
                <div class="hero-tag">
                    <span>Role: Standard User</span>
                </div>
            </div>

            <!-- KPI STATS ROW -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-teal">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="label">Authentication</span>
                        <span class="value">Bcrypt Verified</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <svg viewBox="0 0 24 24">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="label">Database Engine</span>
                        <span class="value">MySQL (XAMPP)</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="label">Session Guard</span>
                        <span class="value">Web (Stateful)</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <svg viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="label">Account Status</span>
                        <span class="value">Active</span>
                    </div>
                </div>
            </div>

            <!-- TWO-COLUMN DETAIL CARDS -->
            <div class="details-grid">
                <!-- PROFILE OVERVIEW -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3>Identity & Account Profile</h3>
                        <span class="badge">Verified Database Row</span>
                    </div>
                    <div class="panel-body">
                        <div class="info-row">
                            <span class="info-label">Full Name:</span>
                            <span class="info-value">{{ $user->full_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">First Name:</span>
                            <span class="info-value">{{ $user->first_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Middle Name:</span>
                            <span class="info-value">{{ $user->middle_name ?? 'None Provided' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Name:</span>
                            <span class="info-value">{{ $user->last_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Username:</span>
                            <span class="info-value">@<span>{{ $user->username }}</span></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Registered Email:</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Member Since:</span>
                            <span class="info-value">{{ $user->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                    </div>
                </div>

                <!-- SYSTEM SECURITY STATUS -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3>Security & Environment Overview</h3>
                        <span class="badge badge-teal">Healthy</span>
                    </div>
                    <div class="panel-body">
                        <div class="security-item">
                            <div class="sec-icon success">✓</div>
                            <div class="sec-text">
                                <strong>CSRF Protection</strong>
                                <p>All state-changing endpoints enforce Cross-Site Request Forgery tokens.</p>
                            </div>
                        </div>
                        <div class="security-item">
                            <div class="sec-icon success">✓</div>
                            <div class="sec-text">
                                <strong>Bcrypt Key Stretching</strong>
                                <p>Your password was salted and hashed prior to being stored in MySQL.</p>
                            </div>
                        </div>
                        <div class="security-item">
                            <div class="sec-icon success">✓</div>
                            <div class="sec-text">
                                <strong>Dual Channel Login</strong>
                                <p>Flexible resolver automatically routes either username or email authentications.</p>
                            </div>
                        </div>
                        <div class="security-item">
                            <div class="sec-icon info">ℹ</div>
                            <div class="sec-text">
                                <strong>Session Regenerated</strong>
                                <p>Session fixation protection refreshed the session token upon authentication.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>