<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    /**
     * @param $partnerId
     * @param $shortDescription
     * @param $longDescription
     * @param $couponNumber
     * @param $quantity
     * @return TierItem
     */
    public function addItem($partnerId, $shortDescription, $longDescription, $couponNumber, $quantity)
    {

        $tierItem = new TierItem();

        $tierItem->tier_id = $this->id;
        $tierItem->partner_id = $partnerId;
        $tierItem->short_description = $shortDescription;
        $tierItem->long_description = $longDescription;
        $tierItem->coupon_number = $couponNumber;
        $tierItem->quantity = $quantity;

        $tierItem->save();

        /** Only add one Promotion Partner per Promotion/Partner (Fulfillment) */
        if (!DB::table('promotion_partners')
            ->where([
                'promotion_id' => $this->promotion_id,
                'partner_id' => $partnerId,
                'purpose' => PromotionPartner::PURPOSE_FULFILLMENT_PARTNER,
            ])
            ->exists()) {

            $promotionPartner = new PromotionPartner();
            $promotionPartner->promotion_id = $this->promotion_id;
            $promotionPartner->partner_id = $partnerId;
            $promotionPartner->purpose = PromotionPartner::PURPOSE_FULFILLMENT_PARTNER;

            $promotionPartner->save();
        }

        return $tierItem;
    }

}
