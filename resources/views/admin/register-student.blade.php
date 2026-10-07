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