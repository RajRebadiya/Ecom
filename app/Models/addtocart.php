<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class addtocart extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'addtocart';

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
