<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consigner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'country',
        'city',
        'address',
        'post_code',
        'phone',
        'role',
        'comission',
        'user_id'
    ];
}
