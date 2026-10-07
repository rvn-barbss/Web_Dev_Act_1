<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $logs = $user->attendances()->orderBy('date', 'desc')->paginate(15);
        
        return view('student.dashboard', compact('user', 'logs'));
    }
}