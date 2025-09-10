<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestPaidProgram extends Model
{
    //
 // حقل الطلبات القابلة للتعبئة
 protected $fillable = [
    'student_id',
    'student_name',
    'paid_program_id',
    'paid_program_name',
    'application_date',
    'type',  // إضافة نوع المنحة
];

// العلاقة مع الطالب
public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}

// العلاقة مع البرنامج المدفوع
public function paidProgram()
{
    return $this->belongsTo(Paidprograms::class, 'paid_program_id');
}

}
