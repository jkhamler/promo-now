<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TierItemStock
 * @package App
 * @property integer $tier_item_id
 * @property string $reference_number
 */
class TierItemStock extends Model
{
    protected $table = 'tier_item_stock';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tierItem()
    {
        return $this->belongsTo('App\Models\TierItem');
    }

}
