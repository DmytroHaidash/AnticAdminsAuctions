<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
