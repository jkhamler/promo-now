<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TierItem
 * @package App\Models
 *
 * @property integer $id
 * @property integer $tier_id
 * @property string $short_description
 * @property string $long_description
 * @property string $coupon_number
 * @property integer $partner_id
 */
class TierItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'tier_id',
        'short_description',
        'long_description',
        'coupon_number',
        'partner_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tier()
    {
        return $this->belongsTo('App\Models\Tier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

}
