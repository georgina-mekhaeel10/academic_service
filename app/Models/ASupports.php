<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class ASupports extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        
        'name',
        'email',
        'password',
        'admin_id',
        
    ];
    
    public $timestamps = true;
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];
     // علاقة مع الأدمن
     public function admin()
     {
         return $this->belongsTo(Admin::class, 'admin_id');
     }

     public function messages()
     {
         return $this->hasMany(Message::class, 'support_id');
     }
     public function conversations()
     {
         return $this->hasMany(Conversation::class, 'support_id');
     }
     protected $hidden = [
        'password', 'remember_token',
    ];
}
