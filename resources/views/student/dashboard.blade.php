@extends('layouts.dashboard')

@section('content')
<div class="hero-banner" style="margin-bottom: 30px;">
    <div class="hero-text">
        <h1>My Attendance Log</h1>
        <p>Review your personal historical check-in and check-out logs recorded by the system.</p>
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
@endsection