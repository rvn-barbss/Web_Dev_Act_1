@extends('layouts.dashboard')

@section('content')
<div class="hero-banner">
    <div class="hero-text">
        <h1>Attendance Logs</h1>
        <p>Comprehensive overview of all student time-ins and time-outs managed by the system.</p>
    </div>
</div>

<div class="data-panel">
    <form class="filter-bar" method="GET" action="{{ route('admin.dashboard') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <input type="text" name="course" placeholder="Filter by Course (e.g. BSIT 3-A)" value="{{ request('course') }}">
        <button type="submit" class="btn-primary">Apply Filter</button>
        <a href="{{ route('admin.dashboard') }}" style="color:#8da2c0; margin-left:10px; align-self:center; text-decoration:none; font-weight: 500;">Reset Filters</a>
    </form>

    <div class="data-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Student Number</th>
                    <th>Student Name</th>
                    <th>Year & Section / Course</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="font-weight: 500;">{{ $log->date->format('Y-m-d') }}</td>
                    <td><span class="badge badge-teal">{{ $log->time_in->format('h:i A') }}</span></td>
                    <td>
                        @if($log->time_out)
                            <span class="badge" style="color:#f59e0b; border: 1px solid rgba(245,158,11,0.3); background: rgba(245,158,11,0.15)">
                                {{ $log->time_out->format('h:i A') }}
                            </span>
                        @else
                            <span style="color: #64748b;">--:-- --</span>
                        @endif
                    </td>
                    <td>{{ $log->user->student_number }}</td>
                    <td style="font-weight: 500; color: white;">{{ $log->user->full_name }}</td>
                    <td>{{ $log->user->course_section }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #8da2c0;">No attendance logs match your query.</td>
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