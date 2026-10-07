@extends('layouts.dashboard')
@section('content')
<div class="hero-banner" style="margin-bottom: 20px;">
    <div class="hero-text">
        <h1>My Personal Attendance</h1>
        <p>Review your historical check-in and check-out logs.</p>
    </div>
</div>

<div class="data-panel">
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->date->format('l, F j, Y') }}</td>
                <td><span class="badge badge-teal">{{ $log->time_in->format('h:i A') }}</span></td>
                <td>
                    @if($log->time_out)
                        <span class="badge" style="color:#f59e0b; border-color: rgba(245,158,11,0.3); background: rgba(245,158,11,0.1)">{{ $log->time_out->format('h:i A') }}</span>
                    @else
                        --:-- --
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; padding: 20px;">No attendance logs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 20px;">{{ $logs->links() }}</div>
</div>
@endsection