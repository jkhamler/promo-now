<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class PromotionPartner
 * @package App\Models
 * @property integer $promotion_id
 * @property integer $partner_id
 * @property string $purpose
 */
class PromotionPartner extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'promotion_id',
        'partner_id',
        'purpose',
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
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

}
