@extends('layouts.dashboard')

@section('content')
<div class="data-panel" style="max-width: 900px; margin: 0 auto; width: 100%;">
    <div class="panel-header">
        <h3>Register New Student</h3>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.register.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h4 style="color: #8da2c0; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">Academic Identity</h4>
        
        <div class="form-grid">
            <div class="input-group">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div class="input-group">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
            </div>
        </div>

        <div class="input-group" style="margin-top: 24px;">
            <label>Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name (Optional)" value="{{ old('middle_name') }}">
        </div>
        
        <div style="margin: 12px 0 35px 0; font-size: 13px; color: #8da2c0; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" id="no_middle_name" name="no_middle_name" value="1" {{ old('no_middle_name') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #15998e; cursor: pointer;">
            <label for="no_middle_name" style="cursor: pointer; margin: 0; font-weight: 500;">I do not have a middle name</label>
        </div>

        <div class="form-grid" style="margin-bottom: 35px;">
            <div class="input-group">
                <label>Student Number (Format: 20**-*****-SR-0)</label>
                <input type="text" name="student_number" placeholder="2026-00001-SR-0" value="{{ old('student_number') }}" required>
            </div>
            <div class="input-group">
                <label>Year & Section / Course</label>
                <input type="text" name="course_section" placeholder="e.g. BSIT 3-A" value="{{ old('course_section') }}" required>
            </div>
            <div class="input-group" style="grid-column: span 2;">
                <label>Upload Picture (JPEG/JPG, max 2MB)</label>
                <input type="file" name="photo" accept=".jpg,.jpeg" required>
            </div>
        </div>

        <h4 style="color: #8da2c0; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; border-top: 1px solid #23334d; padding-top: 25px;">Portal Credentials</h4>

        <div class="form-grid">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="input-group" style="grid-column: span 2;">
                <label>Account Password</label>
                <input type="password" name="password" placeholder="Minimum 8 characters" required>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="margin-top: 40px; padding: 18px; width: 100%;">Register & Save Student</button>
    </form>
</div>

<!-- QR CODE MODAL OVERLAY -->
@if(session('new_qr_token'))
<div id="qr-modal" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(13,23,43,0.95); z-index: 9999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <div style="background: white; padding: 40px; border-radius: 24px; position: relative; text-align: center; max-width: 90%; box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
        
        <!-- X Close Button -->
        <button onclick="document.getElementById('qr-modal').style.display='none'" style="position: absolute; top: -15px; right: -15px; background: #ef4444; color: white; border: 4px solid #0d172b; border-radius: 50%; width: 45px; height: 45px; cursor: pointer; font-weight: bold; font-size: 18px; display: flex; align-items: center; justify-content: center; transition: 0.2s ease; box-shadow: 0 4px 10px rgba(239,68,68,0.4);" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            ✕
        </button>

        <h3 style="color: #0f172a; font-size: 22px; margin-bottom: 5px; font-weight: 700;">Registration Successful!</h3>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Please allow the student to take a picture of this QR code.</p>
        
        <div style="display: inline-block; padding: 10px; border: 2px dashed #cbd5e1; border-radius: 16px;">
            <canvas id="registration-qr"></canvas>
        </div>
        
        <p style="margin-top: 20px; font-weight: 600; color: #10b981; font-size: 15px; background: rgba(16, 185, 129, 0.1); padding: 10px; border-radius: 10px;">
            This acts as their secure ID for attendance.
        </p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
    new QRious({
        element: document.getElementById('registration-qr'),
        value: '{{ session('new_qr_token') }}',
        size: 250,
        level: 'H'
    });
</script>
@endif

@push('scripts')
<script>
    const checkbox = document.getElementById('no_middle_name');
    const middleInput = document.getElementById('middle_name');
    
    function handleMiddleName() {
        if(checkbox.checked) {
            middleInput.value = '';
            middleInput.disabled = true;
            middleInput.style.opacity = '0.4';
        } else {
            middleInput.disabled = false;
            middleInput.style.opacity = '1';
        }
    }
    
    checkbox.addEventListener('change', handleMiddleName);
    handleMiddleName();
</script>
@endpush
@endsection