<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'order_item';

    public function product()
    {
        return $this->hasMany(product::class, 'product_id');
    }
}
