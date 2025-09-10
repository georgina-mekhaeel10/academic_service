<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paidprograms extends Model
{
    //
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
        'application_url'
    ];
    public function university()
    {
        return $this->belongsTo(University::class, 'university_ID');
    }
    public function admin()
{
    return $this->belongsTo(Admin::class, 'admin_id');
}

    // علاقة مع المفضلة (One-to-Many)
    public function favoritePaidPrograms()
    {
        return $this->hasMany(FavoritePaidProgram::class, 'paid_program_id');
    }

}
