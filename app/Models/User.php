<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role', 'first_name', 'middle_name', 'last_name', 
        'username', 'email', 'password', 
        'student_number', 'course_section', 'photo_path'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->middle_name) {
                    return "{$this->first_name} {$this->middle_name} {$this->last_name}";
                }
                return "{$this->first_name} {$this->last_name}";
            }
        );
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}