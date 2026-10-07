@extends('layouts.dashboard')
@section('content')
<div class="hero-banner" style="margin-bottom: 20px;">
    <div class="hero-text">
        <h1>Attendance Logs</h1>
        <p>Comprehensive overview of all student time-ins and time-outs.</p>
    </div>
</div>

<div class="data-panel">
    <form class="filter-bar" method="GET" action="{{ route('admin.dashboard') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <input type="text" name="course" placeholder="Filter by Course (e.g. BSIT 3-A)" value="{{ request('course') }}">
        <button type="submit">Apply Filter</button>
        <a href="{{ route('admin.dashboard') }}" style="color:#8da2c0; margin-left:10px; align-self:center; text-decoration:none;">Clear</a>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Course / Section</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->date->format('Y-m-d') }}</td>
                <td>{{ $log->user->student_number }}</td>
                <td>{{ $log->user->full_name }}</td>
                <td>{{ $log->user->course_section }}</td>
                <td>{{ $log->time_in->format('h:i A') }}</td>
                <td>{{ $log->time_out ? $log->time_out->format('h:i A') : '--:-- --' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">No attendance logs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 20px;">{{ $logs->links() }}</div>
</div>
@endsection