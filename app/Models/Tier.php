<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Tier
 * @package App\Models
 *
 * @property integer $id
 * @property integer $promotion_id
 * @property integer $level
 * @property string $short_description
 * @property string $long_description
 * @property integer $quantity
 *
 */
class Tier extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'promotion_id',
        'level',
        'short_description',
        'long_description',
        'quantity',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\TierItem');
    }

}
