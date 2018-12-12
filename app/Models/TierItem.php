<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TierItem
 * @package App\Models
 */
class TierItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'tier_id',
        'level',
        'short_description',
        'long_description',
        'coupon_number',
        'quantity',
        'partner_id',
    ];
}
