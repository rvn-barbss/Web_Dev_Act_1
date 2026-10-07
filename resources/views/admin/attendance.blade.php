@extends('layouts.dashboard')
@section('content')
<div class="scanner-container">
    <div id="alert-box" class="alert alert-danger" style="display: none; width: 450px;"></div>

    <input type="text" id="scanner_input" class="scanner-input" placeholder="Scan or Type Student Number..." autofocus>
    <p style="color: #64748b; font-size: 13px;">Press Enter to submit.</p>

    <!-- UI MATCHING REFERENCE SOURCE 3 -->
    <div class="student-card" id="student_card">
        <div class="action-badge" id="card_action">Time In Recorded</div>
        <h2 id="card_name">John Doe</h2>
        <img id="card_photo" src="" alt="Student Photo">
        <p id="card_student_number" style="border: 1px solid #cbd5e1; padding: 5px; border-radius: 6px; margin-bottom: 5px;">2026-00001-SR-0</p>
        <p id="card_course" style="border: 1px solid #cbd5e1; padding: 5px; border-radius: 6px; margin-bottom: 5px;">BSIT 3-A</p>
        <p id="card_time" style="margin-top: 15px; font-weight: 700; color: #0f172a;">September 25, 2026 - 12:09 PM</p>
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
            const studentNumber = this.value;
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
            });
        }
    });

    // Keep focus on input automatically
    document.addEventListener('click', () => input.focus());
</script>
@endpush
@endsection