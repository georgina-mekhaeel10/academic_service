<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestScholarship extends Model
{
    //

     // حقل الطلبات القابلة للتعبئة
     protected $fillable = [
        'student_id',
        'student_name',
        'scholarship_id',
        'scholarship_name',
        'application_date',
        'type',  // إضافة نوع المنحة
        'funding_type',  // إضافة نوع التمويل
     ];


      // العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // العلاقة مع المنحة الدراسية
    public function scholarship()
    {
        return $this->belongsTo(Scholarships::class, 'scholarship_id');
    }

}
