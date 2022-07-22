<?php

namespace App\Models;

use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * @property string $number
 * @property string $title
 * @property string $description
 * @property integer $num
 * @property string $author
 * @property float $low_estimate
 * @property float $high_estimate
 * @property float $starting_price
 * @property integer $user_id
 * @property integer $category_id
 * @property string $status
 * @property string $buy_status
 */
class Lots extends Model implements HasMedia
{
    use HasFactory, MediaTrait;

    const BUY_STAUTSES = [
        'in_stock',
        'paid',
        'send',
        'reserved',
    ];
    const STAUTUSES =[
      'warehouse',
      'auction',
      'sold'
    ];

    protected $fillable = [
        'number',
        'title',
        'description',
        'num',
        'author',
        'low_estimate',
        'high_estimate',
        'starting_price',
        'category_id',
        'user_id',
        'status',
        'buy_status',
    ];

    public function category(): HasOne
    {
        $this->hasOne(Category::class);
    }
}
