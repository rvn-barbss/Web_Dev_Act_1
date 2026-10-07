@extends('layouts.dashboard')

@section('content')
<div class="scanner-container">
    <div id="alert-box" class="alert alert-danger" style="display: none; width: 450px;"></div>

    <input type="text" id="scanner_input" class="scanner-input" placeholder="Scan or Type Student Number..." autofocus autocomplete="off">
    <p style="color: #8da2c0; font-size: 14px; font-weight: 500;">Press Enter to submit record.</p>

    <div class="student-card" id="student_card">
        <div class="action-badge" id="card_action">Time In Recorded</div>
        <h2 id="card_name">Name Placeholder</h2>
        
        <img id="card_photo" src="" alt="Student Photo">
        
        <div class="info-pill" id="card_student_number">Student Number Placeholder</div>
        <div class="info-pill" id="card_course">Course Placeholder</div>
        
        <div id="card_time">Timestamp Placeholder</div>
    </div>
</div>

@push('scripts')
<script>
    const input = document.getElementById('scanner_input');
    const card = document.getElementById('student_card');
    const alertBox = document.getElementById('alert-box');

    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const studentNumber = this.value.trim();
            if(!studentNumber) return;

            fetch('{{ route("admin.scanner.scan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ student_number: studentNumber })
            })
            .then(response => response.json())
            .then(data => {
                input.value = '';
                if (data.success) {
                    alertBox.style.display = 'none';
                    card.style.display = 'block';
                    
                    document.getElementById('card_action').textContent = data.action;
                    document.getElementById('card_action').style.background = data.action.includes('Out') ? '#f59e0b' : '#10b981';
                    document.getElementById('card_action').style.boxShadow = data.action.includes('Out') ? '0 4px 15px rgba(245, 158, 11, 0.3)' : '0 4px 15px rgba(16, 185, 129, 0.3)';
                    
                    document.getElementById('card_name').textContent = data.student.name;
                    document.getElementById('card_photo').src = data.student.photo_url;
                    document.getElementById('card_student_number').textContent = data.student.student_number;
                    document.getElementById('card_course').textContent = data.student.course;
                    document.getElementById('card_time').textContent = data.timestamp;
                } else {
                    card.style.display = 'none';
                    alertBox.style.display = 'block';
                    alertBox.textContent = data.message;
                }
            })
            .catch(error => {
                console.error("Server Connection Error:", error);
            });
        }
    });

    document.addEventListener('click', () => {
        if (document.activeElement !== input) {
            input.focus();
        }
    });
</script>
@endpush
@endsection