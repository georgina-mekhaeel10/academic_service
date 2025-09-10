<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'phone',
        'gender',
        'website_rate',
        'is_blocked',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function messages()
    {
        return $this->hasMany(Message::class, 'student_id');
    }

        // علاقة مع طلبات المنح الدراسية (One-to-Many)
    public function requestScholarships()
    {
        return $this->hasMany(RequestScholarship::class, 'student_id');
    }
    
    public function courseApplications()
    {
        return $this->hasMany(CourseApplication::class, 'student_id');
    }
    
    public function favoriteCourses()
    {
        return $this->hasMany(FavoriteCourse::class, 'student_id');
    }

    // public function favoriteScholarships()
    // {
    //     return $this->hasMany(FavoriteScholarship::class, 'student_id');
    // }

    // public function favoritePaidPrograms()
    // {
    //     return $this->hasMany(FavoritePaidProgram::class, 'student_id');
    // }
    public function favoriteScholarships()
        {
            return $this->hasMany(FavoriteScholarship::class, 'student_id');
        }

    public function favoritePaidPrograms()
    {
        return $this->hasMany(FavoritePaidProgram::class, 'student_id');
    }
}