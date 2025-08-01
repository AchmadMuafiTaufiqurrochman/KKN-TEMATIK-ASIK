<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparat extends Model
{
    use HasFactory;

    protected $table = 'aparat'; // <- Ini penting!

    protected $fillable = [
        'name',
        'nip',
        'position',
        'gender',
        'photo',
    ];
}
