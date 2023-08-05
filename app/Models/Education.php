<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'school', // Add 'school' to the fillable fields
        'degree',
        'graduation_year',
        'faculty',
        'user_id',//to be change to user
    ];

    public function resume() {
        return $this->belongsTo(Resume::class);
    }
}
