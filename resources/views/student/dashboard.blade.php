@extends('layouts.dashboard')

@section('content')
<div class="hero-banner" style="margin-bottom: 30px; display: flex; flex-direction: row; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
    <div class="hero-text">
        <h1>My Attendance Log</h1>
        <p>Review your personal historical check-in and check-out logs recorded by the system.</p>
    </div>
    
    <div style="background: white; padding: 15px; border-radius: 16px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <canvas id="my-qr" style="margin-bottom: 5px;"></canvas>
        <p style="color: #0f172a; font-size: 13px; font-weight: 700; margin-bottom: 12px;">My QR Code</p>
        
        <!-- Download Button -->
        <button onclick="downloadQR()" style="background: var(--gradient-primary); color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; cursor: pointer; font-weight: 600; width: 100%; transition: 0.3s ease; box-shadow: 0 4px 10px rgba(21,153,142,0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            Download QR
        </button>
    </div>
</div>

<div class="data-panel">
    <div class="data-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date Recorded</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="font-weight: 500; color: white;">{{ $log->date->format('l, F j, Y') }}</td>
                    <td>
                        <span class="badge badge-teal">{{ $log->time_in->format('h:i A') }}</span>
                    </td>
                    <td>
                        @if($log->time_out)
                            <span class="badge" style="color:#f59e0b; border: 1px solid rgba(245,158,11,0.3); background: rgba(245,158,11,0.15)">
                                {{ $log->time_out->format('h:i A') }}
                            </span>
                        @else
                            <span style="color: #64748b;">--:-- --</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 40px; color: #8da2c0;">No attendance logs found for your account.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top: 25px;">
        {{ $logs->links() }}
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
    // Generate QR
    new QRious({
        element: document.getElementById('my-qr'),
        value: '{{ $user->qr_token }}',
        size: 140,
        level: 'H'
    });

    // Download Function
    function downloadQR() {
        const canvas = document.getElementById('my-qr');
        const link = document.createElement('a');
        
        // Formats filename as: My_Attendance_QR_2026-00001-SR-0.png
        link.download = 'My_Attendance_QR_{{ $user->student_number }}.png';
        link.href = canvas.toDataURL('image/png');
        
        // Trigger Download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endpush
@endsection