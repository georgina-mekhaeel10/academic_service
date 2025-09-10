<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'university_ID', 
        'name', 
        'description', 
        'start_date', 
        'end_date', 
        'cost',
        'type',
        'country',   
        'uploaded_data', 
        'application_url',
        'duration',
        'level',
        'language',
        'instructor',
        'max_students'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_ID');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // علاقة مع طلبات التسجيل في الكورسات (إذا كانت موجودة)
    // public function courseRequests()
    // {
    //     return $this->hasMany(RequestCourse::class, 'course_id');
    // }
}