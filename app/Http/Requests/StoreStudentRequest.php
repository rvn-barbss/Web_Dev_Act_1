<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'middle_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'course_section' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'alpha_dash', 'max:30', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'student_number' => [
                'required', 
                'string', 
                'regex:/^20(?:[0-1][0-9]|2[0-6])-\d{5}-SR-0$/', 
                'unique:users,student_number'
            ],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'student_number.regex' => 'Student number must follow 20**-*****-SR-0 format and year cannot exceed 2026.',
        ];
    }
}