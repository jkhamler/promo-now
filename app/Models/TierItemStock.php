<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TierItemStock
 * @package App
 * @property integer $tier_item_id
 * @property string $reference_number
 * @property \DateTime $allocated_datetime
 */
class TierItemStock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tier_item_stock';

    protected $dates = [
        'created_at',
        'updated_at',
        'allocated_datetime',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'tier_item_id',
        'reference_number',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tierItem()
    {
        return $this->belongsTo('App\Models\TierItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entrants()
    {
        return $this->belongsToMany('App\Models\Entrant', 'entrant_tier_item_stock')->using('App\Models\EntrantTierItemStock');
    }


}
