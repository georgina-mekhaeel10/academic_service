<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarships extends Model
{
    // 
    protected $primaryKey = 'scholarships_ID';

    protected $fillable = [
        'university_ID', 
        'name', 
        'description', 
        'start_date', 
        'end_date', 
        'cost', 
        'type',
        'funding_type', 
        'funding_amount',
         'eligibility_criteria', 
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

    // علاقة مع طلبات المنح الدراسية (One-to-Many)
    public function requestScholarships()
    {
        return $this->hasMany(RequestScholarship::class, 'scholarship_id');
    }

    // علاقة مع المفضلة (One-to-Many)
    public function favoriteScholarships()
    {
        return $this->hasMany(FavoriteScholarship::class, 'scholarship_id', 'scholarships_ID');
    }

}
