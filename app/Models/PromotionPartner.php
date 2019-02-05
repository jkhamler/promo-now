<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PromotionPartner
 * @package App\Models
 * @property integer $promotion_id
 * @property integer $partner_id
 * @property string $purpose
 * @property string $notes
 */
class PromotionPartner extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const PURPOSE_PROMOTER = 'PURPOSE_PROMOTER';
    const PURPOSE_CREATIVE_AGENCY = 'PURPOSE_CREATIVE_AGENCY';
    const PURPOSE_PARTNER_AGENCY = 'PURPOSE_PARTNER_AGENCY';
    const PURPOSE_FULFILLMENT_PARTNER = 'PURPOSE_FULFILLMENT_PARTNER';

    const ALL_PURPOSES = [
        SELF::PURPOSE_PROMOTER => 'Promoter',
        SELF::PURPOSE_CREATIVE_AGENCY => 'Creative Agency',
        SELF::PURPOSE_PARTNER_AGENCY => 'Partner Agency',
        SELF::PURPOSE_FULFILLMENT_PARTNER => 'Fulfillment Partner',
    ];

    const PURPOSES = [
        SELF::PURPOSE_PROMOTER => 'Promoter',
        SELF::PURPOSE_CREATIVE_AGENCY => 'Creative Agency',
        SELF::PURPOSE_PARTNER_AGENCY => 'Partner Agency',
    ];


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


    /**
     * @param null $purpose
     * @return string|null
     */
    public function getPurposeLabel($purpose = null)
    {
        if (is_null($purpose)) {
            $purpose = $this->purpose;
        }
        return self::ALL_PURPOSES[$purpose] ?? null;
    }


}
