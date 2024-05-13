<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;

class product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'products';
    public function category()
    {
        return $this->belongsTo(category::class, 'c_id');
    }
}
