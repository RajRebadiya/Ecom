<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class user_data extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    public $table = 'users';
    // Define the table associated with the model

    // Specify the fields that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hide sensitive fields from arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
