<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TierItem
 * @package App\Models
 *
 * @property integer $id
 * @property integer $tier_id
 * @property integer $level
 * @property string $short_description
 * @property string $long_description
 * @property string $coupon_number
 * @property integer $quantity
 * @property integer $partner_id
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
