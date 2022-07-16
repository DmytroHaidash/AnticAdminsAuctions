<?php

namespace App\Models;

use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Lots extends Model implements HasMedia
{
    use HasFactory, MediaTrait;

    protected $fillable = [
        'title',
    ];
}
