<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('register.css') }}">
</head>
<body>
<div class="register-page">
    <!-- LEFT SIDE -->
    <section class="left-side">
        <!-- Decorative Shapes -->
        <div class="big-circle"></div>
        <div class="circle circle-top"></div>
        <div class="circle circle-bottom-left"></div>
        <div class="circle circle-bottom-right"></div>

        <!-- Join Content -->
        <div class="welcome-content">
            <div class="user-icon-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="7" r="3.5"></circle>
                    <path d="M2.5 20v-2 c0-3 2.4-5.4 5.4-5.4 h2.5 c3 0 5.4 2.4 5.4 5.4v2"></path>
                    <path d="M18 6v6"></path>
                    <path d="M15 9h6"></path>
                </svg>
            </div>
            <h2>Join Us Today</h2>
            <p>Create an account and start your journey with us</p>
        </div>
    </section>

    <!-- RIGHT SIDE -->
    <section class="right-side">
        <div class="register-box">
            <h1>Create Account</h1>
            <p class="subtitle">Fill in the details below to get started</p>

            <form action="/login">
                <!-- FIRST ROW -->
                <div class="form-row">
                    <!-- FULL NAME -->
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" name="fullname" placeholder="Full Name" required>
                    </div>

                    <!-- USERNAME -->
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="input-group">
                    <svg class="input-icon" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 7l9 6 9-6"></path>
                    </svg>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <!-- PASSWORD ROW -->
                <div class="form-row">
                    <!-- PASSWORD -->
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7 a4 4 0 0 1 8 0v3"></path>
                        </svg>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7 a4 4 0 0 1 8 0v3"></path>
                        </svg>
                        <input type="password" name="confirm-password" placeholder="Confirm Password" required>
                    </div>
                </div>

                <!-- REGISTER BUTTON -->
                <button type="submit" class="register-button">CREATE ACCOUNT</button>
            </form>

            <!-- LOGIN LINK -->
            <div class="signin-link">
                <span>Already have an account?</span>
                <a href="/login">Sign In →</a>
            </div>
        </div>
    </section>
</div>
</body>
</html>