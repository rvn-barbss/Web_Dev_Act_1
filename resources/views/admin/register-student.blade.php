@extends('layouts.dashboard')
@section('content')
<div class="data-panel" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-header">
        <h3>Student Registration Console</h3>
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

        <div class="input-group" style="margin-top: 10px;">
            <label>Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
        </div>
        <div style="margin-bottom: 20px; font-size: 13px; color: #8da2c0;">
            <label><input type="checkbox" id="no_middle_name" name="no_middle_name" value="1" {{ old('no_middle_name') ? 'checked' : '' }}> I do not have a middle name</label>
        </div>

        <div class="form-grid">
            <div class="input-group">
                <label>Student Number (Format: 20**-*****-SR-0)</label>
                <input type="text" name="student_number" placeholder="2026-00001-SR-0" value="{{ old('student_number') }}" required>
            </div>
            <div class="input-group">
                <label>Year & Section / Course</label>
                <input type="text" name="course_section" placeholder="e.g. BSIT 3-A" value="{{ old('course_section') }}" required>
            </div>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="input-group">
                <label>Profile Picture (JPEG/JPG, max 2MB)</label>
                <input type="file" name="photo" accept=".jpg,.jpeg" required style="background: none; border: 1px dashed #35435a;">
            </div>
        </div>

        <button type="submit" class="btn-primary">Register Student</button>
    </form>
</div>

@push('scripts')
<script>
    const checkbox = document.getElementById('no_middle_name');
    const middleInput = document.getElementById('middle_name');
    checkbox.addEventListener('change', function() {
        if(this.checked) {
            middleInput.value = '';
            middleInput.disabled = true;
            middleInput.style.opacity = '0.5';
        } else {
            middleInput.disabled = false;
            middleInput.style.opacity = '1';
        }
    });
</script>
@endpush
@endsection