<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


/**
 * Class EntrantTierItem
 * @package App\Models
 *
 * @property integer $entrant_id
 * @property integer $tier_stock_item_id
 */
class EntrantTierStockItem extends Pivot
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'entrant_tier_stock_items';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'entrant_id',
        'tier_stock_item_id',
        'claimed_datetime',
    ];
}

