<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'duration',
    ];
    protected $table = 'sponsors';
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
