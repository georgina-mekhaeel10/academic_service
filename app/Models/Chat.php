<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $fillable = ['student_id', 'support_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function support()
    {
        return $this->belongsTo(Support::class, 'support_id');
    }
}
