<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'about_me',
        'user_id',
        'public_url',
    ];
    public function educations() {
        return $this->hasMany(Education::class);
    }
    
    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}

