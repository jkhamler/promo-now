<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Entrant
 * @package App\Models
 *
 * @property integer $person_id
 * @property integer $urn_id
 * @property integer $promotion_id
 * @property string $ip_address
 * @property string $user_agent
 */
class Entrant extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'person_id',
        'urn_id',
        'promotion_id',
        'ip_address',
        'user_agent',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tierItemStock()
    {
        return $this->belongsToMany('App\Models\TierItemStock', 'entrant_tier_item_stock')->using('App\Models\EntrantTierItemStock');
    }


}
