<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
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

        while (User::where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
