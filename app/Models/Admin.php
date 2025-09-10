<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Admin extends Authenticatable
{
    //
    use Notifiable;
   
    // خصائص الجدول
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
      // علاقة مع الدعم
      public function a_supports()
      {
          return $this->hasMany(ASupports::class, 'admin_id');
      }

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function reports()
{
    return $this->hasMany(Report::class, 'generated_by');
}
public function universities()
{
    return $this->hasMany(University::class, 'admin_id');
}
public function scholarships()
{
    return $this->hasMany(Scholarships::class, 'admin_id');
}
public function paidPrograms()
{
    return $this->hasMany(Paidprograms::class, 'admin_id');
}



}
