<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'gender',
        'birth_date',
        'job',
        'education',
        'rt',
        'rw',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function getGenderTextAttribute()
    {
        return $this->gender === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getAgeAttribute()
    {
        return $this->birth_date->age;
    }
}