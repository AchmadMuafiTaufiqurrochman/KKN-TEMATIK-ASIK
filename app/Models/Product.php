<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name_product',
    'description',
    'category',
    'contact',
    'status',
    'owner',
    'latitude',
    'longitude',
    'image',
];

}
