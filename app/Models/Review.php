<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'text',
        'vote',
    ];
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
