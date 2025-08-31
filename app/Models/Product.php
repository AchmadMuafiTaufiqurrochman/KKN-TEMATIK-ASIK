<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_product',
        'owner',
        'description',
        'category',
        'contact',
        'image',
        'map_location_id',
        'status',
    ];

    public function mapLocation()
    {
        return $this->belongsTo(MapLocation::class, 'map_location_id');
    }
}
