<?php

namespace App\Models;

use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * @property string $title
 * @property string $description
 * @property integer $num
 * @property string $artist
 * @property float $low_estimate
 * @property float $high_estimate
 * @property float $starting_price
 * @property integer $user_id
 * @property integer $category_id
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
        'starting_price',
        'category_id',
        'user_id'
    ];
}
