<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    //
   
    protected $fillable = [
        'name',
        'description',
        'location',
        'established_year',
        'website',
    ];
   
    public function scholarships()
    {
        return $this->hasMany(Scholarships::class, 'university_ID');
    }
    public function admin()
{
    return $this->belongsTo(Admin::class, 'admin_id');
}


}
