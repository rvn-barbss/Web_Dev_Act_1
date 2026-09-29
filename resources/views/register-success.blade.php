<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created Successfully</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('register-success.css') }}">
</head>
<body>
<main class="success-page">
    <div class="success-container">
        <!-- SUCCESS ICON -->
        <div class="success-icon-wrapper">
            <div class="success-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="7" r="3"></circle>
                    <path d="M3 19 v-1.5 c0-2.8 2.2-5 5-5 h2 c1 0 1.9.3 2.7.8"></path>
                    <path d="M14 17 l2.2 2.2 L21 14"></path>
                </svg>
            </div>
        </div>

        <!-- TITLE -->
        <h1>Account Created!</h1>

        <!-- MESSAGE -->
        <p>Your account has been successfully registered in the database. You can now log in using your credentials.</p>

        <!-- LOGIN BUTTON -->
        <a href="{{ route('login') }}" class="continue-button">Continue to Login →</a>
    </div>
</main>
</body>
</html>