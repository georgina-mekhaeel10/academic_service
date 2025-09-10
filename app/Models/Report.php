<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'report_type', // مثل "students"
        'start_date',
        'end_date',
        'generated_by', // معرف المستخدم الذي أنشأ التقرير
    ];
    public function admin()
{
    return $this->belongsTo(Admin::class, 'generated_by');
}
}
