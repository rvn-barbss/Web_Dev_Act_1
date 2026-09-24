<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
</head>
<body>
<div class="login-page">
    <!-- LEFT SIDE -->
    <section class="left-side">
        <!-- Decorative Shapes -->
        <div class="big-circle"></div>
        <div class="circle circle-top"></div>
        <div class="circle circle-bottom-left"></div>
        <div class="circle circle-bottom-right"></div>

        <!-- Welcome Content -->
        <div class="welcome-content">
            <div class="user-icon-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M4 21v-2.5 c0-3 2.5-5.5 5.5-5.5 h5 c3 0 5.5 2.5 5.5 5.5 V21"></path>
                </svg>
            </div>
            <h2>Welcome Back</h2>
            <p>Sign in to continue to your secure dashboard</p>
        </div>
    </section>

    <!-- RIGHT SIDE -->
    <section class="right-side">
        <div class="login-box">
            <h1>User Login</h1>
            <p class="subtitle">Enter your credentials to access your account</p>

            <form action="/success">
                <!-- USERNAME -->
                <div class="input-group">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="3.5"></circle>
                        <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                    </svg>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <!-- PASSWORD -->
                <div class="input-group">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                        <path d="M8 10V7 a4 4 0 0 1 8 0v3"></path>
                    </svg>
                    <input type="password" name="password" placeholder="Password" required>
                    <svg class="eye-icon" viewBox="0 0 24 24">
                        <path d="M2.5 12 s3.5-5 9.5-5 9.5 5 9.5 5 -3.5 5 -9.5 5 -9.5-5 -9.5-5z"></path>
                        <circle cx="12" cy="12" r="2.5"></circle>
                    </svg>
                </div>

                <!-- LOGIN -->
                <button type="submit" class="login-button">LOGIN</button>
            </form>

            <!-- FORGOT PASSWORD -->
            <div class="forgot-password">
                <a href="#">Forgot Username / Password?</a>
            </div>

            <!-- REGISTER -->
            <div class="create-account">
                <span>Don't have an account?</span>
                <a href="/register">Create Your Account →</a>
            </div>
        </div>
    </section>
</div>
</body>
</html>