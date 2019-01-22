<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


/**
 * Class EntrantTierItem
 * @package App\Models
 *
 * @property integer $entrant_id
 * @property integer $tier_item_id
 */
class EntrantTierItem extends Pivot
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'entrant_id',
        'tier_item_id',
        'claimed_datetime',
    ];
}

