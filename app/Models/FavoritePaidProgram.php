<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritePaidProgram extends Model
{
    protected $fillable = [
        'student_id',
        'paid_program_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function paidProgram()
    {
        return $this->belongsTo(Paidprograms::class, 'paid_program_id');
    }
}
