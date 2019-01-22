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
 * @property integer $quantity
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
        'quantity',
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stock()
    {
        return $this->hasMany('App\Models\TierItemStock');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unallocatedStock()
    {
        return $this->hasMany('App\Models\TierItemStock')->whereNull('allocated_datetime');
    }


}
