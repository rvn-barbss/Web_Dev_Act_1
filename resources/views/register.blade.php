<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('register.css') }}">
</head>
<body>
<div class="register-page">
    <!-- LEFT SIDE -->
    <section class="left-side">
        <div class="big-circle"></div>
        <div class="circle circle-top"></div>
        <div class="circle circle-bottom-left"></div>
        <div class="circle circle-bottom-right"></div>

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
            <p class="subtitle">Fill in your information below to register</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <!-- FIRST NAME & LAST NAME -->
                <div class="form-row">
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <!-- MIDDLE NAME & CHECKBOX -->
                <div class="middle-name-wrapper">
                    <div class="input-group" id="middle-name-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name (Optional)" value="{{ old('middle_name') }}">
                    </div>

                    <div class="checkbox-container">
                        <label class="custom-checkbox">
                            <input type="checkbox" id="no_middle_name" name="no_middle_name" value="1" {{ old('no_middle_name') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <span class="label-text">I do not have a middle name</span>
                        </label>
                    </div>
                </div>

                <!-- USERNAME & EMAIL -->
                <div class="form-row">
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="3.5"></circle>
                            <path d="M5.5 20v-2 c0-2.8 2.2-5 5-5 h3 c2.8 0 5 2.2 5 5v2"></path>
                        </svg>
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    </div>

                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M3 7l9 6 9-6"></path>
                        </svg>
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                </div>

                <!-- PASSWORD & CONFIRM PASSWORD -->
                <div class="form-row">
                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7 a4 4 0 0 1 8 0v3"></path>
                        </svg>
                        <input type="password" name="password" placeholder="Password (min 8 chars)" required>
                    </div>

                    <div class="input-group">
                        <svg class="input-icon" viewBox="0 0 24 24">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7 a4 4 0 0 1 8 0v3"></path>
                        </svg>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>

                <button type="submit" class="register-button">CREATE ACCOUNT</button>
            </form>

            <div class="signin-link">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">Sign In →</a>
            </div>
        </div>
    </section>
</div>

<script>
    const noMiddleNameCheckbox = document.getElementById('no_middle_name');
    const middleNameInput = document.getElementById('middle_name');

    function toggleMiddleName() {
        if (noMiddleNameCheckbox.checked) {
            middleNameInput.value = '';
            middleNameInput.disabled = true;
            middleNameInput.placeholder = 'No Middle Name';
            middleNameInput.style.opacity = '0.5';
            middleNameInput.style.cursor = 'not-allowed';
        } else {
            middleNameInput.disabled = false;
            middleNameInput.placeholder = 'Middle Name (Optional)';
            middleNameInput.style.opacity = '1';
            middleNameInput.style.cursor = 'text';
        }
    }

    noMiddleNameCheckbox.addEventListener('change', toggleMiddleName);
    window.addEventListener('DOMContentLoaded', toggleMiddleName);
</script>
</body>
</html>