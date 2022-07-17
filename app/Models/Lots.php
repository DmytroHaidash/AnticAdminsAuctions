<?php

namespace App\Models;

use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * @property string $title
 * @property text $description
 * @property
 */
class Lots extends Model implements HasMedia
{
    use HasFactory, MediaTrait;

    protected $fillable = [
        'title',
        'description',
        'num',
        'artist',
        'low_estimate',
        'high_estimate',
        'category',
        'starting_price',
        'category_id',
        'user_id'
    ];
}
