<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Mail\Message;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'doctor_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'doctor_id');
    }
}
