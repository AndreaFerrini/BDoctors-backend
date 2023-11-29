<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
