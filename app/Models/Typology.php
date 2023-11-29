<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Typology extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
