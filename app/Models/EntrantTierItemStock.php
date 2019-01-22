<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


/**
 * Class EntrantTierItem
 * @package App\Models
 *
 * @property integer $entrant_id
 * @property integer $tier_item_stock_id
 */
class EntrantTierItemStock extends Pivot
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'entrant_tier_item_stock';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'entrant_id',
        'tier_item_stock_id',
        'claimed_datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tierItem()
    {
        return $this->belongsTo('App\Models\TierItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entrant()
    {
        return $this->belongsTo('App\Models\Entrant');
    }


}

