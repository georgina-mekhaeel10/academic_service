<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseApplication extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'status',
        'applied_at',
        'notes'
    ];

    protected $casts = [
        'applied_at' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}