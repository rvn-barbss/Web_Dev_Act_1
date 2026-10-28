@extends('layouts.dashboard')

@section('content')
<style>
    /* Custom layout for the attendance console to eliminate scrolling */
    .attendance-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        min-height: calc(100vh - 165px); /* Uses remaining screen height */
        align-items: center;
    }
    
    .scanner-side {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--bg-card);
        padding: 40px;
        border-radius: 24px;
        border: 1px solid var(--border-light);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .result-side {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    /* Override card styles for this layout */
    .student-card {
        margin: 0 !important;
        width: 100%;
        max-width: 480px;
    }
    
    @media (max-width: 1024px) {
        .attendance-wrapper {
            grid-template-columns: 1fr;
            min-height: auto;
        }
    }
</style>

<div class="attendance-wrapper">
    <!-- LEFT SIDE: Scanner & Input -->
    <div class="scanner-side">
        <!-- WebCam View for QR Code Scanning -->
        <div style="width: 100%; max-width: 450px; background: #000; padding: 5px; border-radius: 20px; border: 2px solid var(--border-light); margin-bottom: 20px;">
            <div id="reader" style="width: 100%; border-radius: 15px; overflow: hidden; background: #000;"></div>
        </div>
        
        <p style="color: #8da2c0; font-size: 14px; font-weight: 600; margin: 15px 0;">— OR MANUALLY TYPE —</p>

        <!-- Fallback Text Input -->
        <input type="text" id="scanner_input" class="scanner-input" style="width: 100%; max-width: 450px;" placeholder="Type Student Number..." autofocus autocomplete="off">
        <p style="color: #8da2c0; font-size: 13px; font-weight: 500; margin-top: 10px;">Press Enter to submit manually.</p>
    </div>

    <!-- RIGHT SIDE: Results -->
    <div class="result-side">
        <div id="alert-box" class="alert alert-danger" style="display: none; width: 100%; max-width: 480px;"></div>

        <!-- Success Result Card -->
        <div class="student-card" id="student_card" style="display: none;">
            <div class="action-badge" id="card_action">Time In Recorded</div>
            <h2 id="card_name">Name Placeholder</h2>
            
            <img id="card_photo" src="" alt="Student Photo">
            
            <div class="info-pill" id="card_student_number">Student Number Placeholder</div>
            <div class="info-pill" id="card_course">Course Placeholder</div>
            
            <div id="card_time">Timestamp Placeholder</div>
        </div>
        
        <!-- Idle State (Shown when waiting for scan) -->
        <div id="idle_state" style="text-align: center; color: #8da2c0;">
            <svg viewBox="0 0 24 24" style="width: 80px; height: 80px; fill: none; stroke: #23334d; stroke-width: 1; margin-bottom: 15px;">
                <path d="M3 7V5a2 2 0 0 1 2-2h2M21 7V5a2 2 0 0 0-2-2h-2M3 17v2a2 2 0 0 0 2 2h2M21 17v2a2 2 0 0 1-2 2h-2" stroke-linecap="round"/>
                <rect x="8" y="8" width="8" height="8" rx="1"/>
            </svg>
            <h3 style="font-size: 20px; font-weight: 600; color: white; margin-bottom: 5px;">Ready to Scan</h3>
            <p style="font-size: 14px;">Waiting for student QR code...</p>
        </div>
    </div>
</div>

@push('scripts')
<!-- HTML5-QRCode Library for scanning -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    let hideTimeout;
    const alertBox = document.getElementById('alert-box');
    const card = document.getElementById('student_card');
    const idleState = document.getElementById('idle_state');
    const input = document.getElementById('scanner_input');
    
    // Prevent double scans from happening simultaneously
    window.isScanning = false;

    function resetToIdle() {
        card.style.display = 'none';
        alertBox.style.display = 'none';
        idleState.style.display = 'block';
    }

    function executeScan(identifier) {
        fetch('{{ route("admin.scanner.scan") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ identifier: identifier })
        })
        .then(response => {
            if (response.status === 429) {
                throw new Error("Too many requests. You're being rate limited.");
            }
            return response.json();
        })
        .then(data => {
            input.value = '';
            clearTimeout(hideTimeout);
            idleState.style.display = 'none';

            if (data.success) {
                alertBox.style.display = 'none';
                card.style.display = 'block';
                
                // .textContent is used deliberately over .innerHTML to prevent Scripting (XSS)
                document.getElementById('card_action').textContent = data.action;
                document.getElementById('card_action').style.background = data.action.includes('Out') ? '#f59e0b' : '#10b981';
                document.getElementById('card_action').style.boxShadow = data.action.includes('Out') ? '0 4px 15px rgba(245, 158, 11, 0.3)' : '0 4px 15px rgba(16, 185, 129, 0.3)';
                
                document.getElementById('card_name').textContent = data.student.name;
                document.getElementById('card_photo').src = data.student.photo_url;
                document.getElementById('card_student_number').textContent = data.student.student_number;
                document.getElementById('card_course').textContent = data.student.course;
                document.getElementById('card_time').textContent = data.timestamp;

                // Close Card after Exactly 5 Seconds
                hideTimeout = setTimeout(resetToIdle, 5000);
            } else {
                card.style.display = 'none';
                alertBox.style.display = 'block';
                alertBox.textContent = data.message;
                
                // Hide error after exactly 5 seconds
                hideTimeout = setTimeout(resetToIdle, 5000);
            }
        })
        .catch(error => {
            console.error("Server Connection Error:", error);
            idleState.style.display = 'none';
            card.style.display = 'none';
            alertBox.style.display = 'block';
            alertBox.textContent = error.message || "Failed to communicate with server.";
            
            hideTimeout = setTimeout(resetToIdle, 5000);
        });
    }

    // Listener for manual input
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const val = this.value.trim();
            if(val) executeScan(val);
        }
    });

    // Re-focus the input if user clicks elsewhere (keeps scanning active)
    document.addEventListener('click', (e) => {
        if (document.activeElement !== input && !e.target.closest('#reader')) {
            input.focus();
        }
    });

    // Initialize QR Code Scanner
    const html5QrcodeScanner = new Html5QrcodeScanner("reader", { 
        fps: 10, 
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    }, false);
    
    html5QrcodeScanner.render((decodedText, decodedResult) => {
        // Prevent spam scans (3-second cooldown between physical camera scans)
        if (window.isScanning) return;
        window.isScanning = true;
        
        executeScan(decodedText);
        
        setTimeout(() => { 
            window.isScanning = false; 
        }, 3000);
    });
</script>
@endpush
@endsection