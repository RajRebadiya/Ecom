<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_data extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'users';
}
