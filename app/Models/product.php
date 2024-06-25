<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use Nette\Utils\Image;

class product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'products';
    protected $fillable = [
        'name',
        'c_id',
        'description',
        'color',
        'size',
        'price',
        'qty',
        'sell_price',
        'image', // Add 'images' to the $fillable array
    ];
    public function category()
    {
        return $this->belongsTo(category::class, 'c_id');
    }

    public function images()
    {
        return $this->hasMany(product::class);
    }
}
