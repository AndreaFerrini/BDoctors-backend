<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Review;
use Illuminate\Support\Str;
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


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doctor) {
            if (!$doctor->user_id) {
                $doctor->user_id = auth()->user()->id;
            }
        });
    }


    public function getRouteKey()
    {
        return $this->slug;
    }

    public static function slugger($string)
    {
        $baseSlug = Str::slug($string);

        $i = 1;

        $slug = $baseSlug;

        while (Doctor::where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
