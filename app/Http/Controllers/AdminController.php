<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Attendance::with('user')->orderBy('date', 'desc')->orderBy('time_in', 'desc');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('course')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('course_section', 'like', '%' . $request->course . '%');
            });
        }

        $logs = $query->paginate(15);
        return view('admin.dashboard', compact('logs'));
    }

    public function showRegister()
    {
        return view('admin.register-student');
    }

    public function registerStudent(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        $hasNoMiddleName = $request->has('no_middle_name');

        // Automated File Handling
        $photo = $request->file('photo');
        $filename = $validated['student_number'] . '.' . $photo->getClientOriginalExtension();
        $photoPath = $photo->storeAs('profiles', $filename, 'public');

        User::create([
            'role' => 'student',
            'first_name' => $validated['first_name'],
            'middle_name' => $hasNoMiddleName ? null : ($validated['middle_name'] ?? null),
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'student_number' => $validated['student_number'],
            'course_section' => $validated['course_section'],
            'photo_path' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Student successfully registered.');
    }

    public function showScanner()
    {
        return view('admin.attendance');
    }

    public function processScan(Request $request)
    {
        $studentNumber = $request->input('student_number');
        $student = User::where('student_number', $studentNumber)->where('role', 'student')->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student record not found in database.']);
        }

        $today = now()->format('Y-m-d');
        $attendance = Attendance::where('user_id', $student->id)->whereDate('date', $today)->first();
        
        $action = '';
        $timestamp = now()->format('Y-m-d h:i:s A');

        if (!$attendance) {
            Attendance::create([
                'user_id' => $student->id,
                'date' => $today,
                'time_in' => now(),
            ]);
            $action = 'Time In Recorded';
        } elseif (!$attendance->time_out) {
            $attendance->update(['time_out' => now()]);
            $action = 'Time Out Recorded';
        } else {
            return response()->json(['success' => false, 'message' => 'Attendance already fully recorded for today.']);
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'timestamp' => $timestamp,
            'student' => [
                'name' => $student->full_name,
                'student_number' => $student->student_number,
                'course' => $student->course_section,
                'photo_url' => asset('storage/' . $student->photo_path)
            ]
        ]);
    }
}