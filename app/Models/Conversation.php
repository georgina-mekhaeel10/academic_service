<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
   

    protected $fillable = ['student_id', 'subject'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function support()
    {
        return $this->belongsTo(ASupport::class, 'support_id');
    }
}
