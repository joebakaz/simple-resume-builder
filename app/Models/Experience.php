<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'job_title',
        'start_date',
        'end_date',
        'job_description',
        'user_id', //to change to user
    ];
    public function resume() {
        return $this->belongsTo(Resume::class);
    }
}
