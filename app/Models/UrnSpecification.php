<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UrnSpecification
 * @package App\Models
 *
 * @property integer $id
 * @property string $reference_id
 * @property integer $promotion_id
 * @property integer $tier_item_id
 * @property string $batch_name
 * @property string $purpose
 * @property integer $length
 * @property string $included_characters
 * @property string $regex_exclude
 * @property integer $profanity_check_language_id
 * @property integer $urn_quantity
 * @property integer $winning_urn_quantity
 * @property boolean $pi_to_generate
 * @property boolean $everyone_gets
 * @property boolean $allocated_by_tier
 */
class UrnSpecification extends Model
{
    const URN_PURPOSE_PRINTERS = 'URN_PURPOSE_PRINTERS';
    const URN_PURPOSE_CUSTOMER_SERVICE = 'URN_PURPOSE_CUSTOMER_SERVICE';
    const URN_PURPOSE_BRAND_TESTING = 'URN_PURPOSE_BRAND_TESTING';
    const URN_PURPOSE_PI_TESTING = 'URN_PURPOSE_PI_TESTING';

    const PURPOSES = [
        self::URN_PURPOSE_PRINTERS => 'Printers',
        self::URN_PURPOSE_CUSTOMER_SERVICE => 'Customer Service',
        self::URN_PURPOSE_BRAND_TESTING => 'Brand Testing',
        self::URN_PURPOSE_PI_TESTING => 'PI Testing',
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
        'reference_id',
        'promotion_id',
        'batch_name',
        'purpose',
        'length',
        'included_characters',
        'regex_exclude',
        'profanity_check_language_id',
        'urn_quantity',
        'winning_urn_quantity',
        'pi_to_generate',
        'everyone_gets',
        'allocated_by_tier',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
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
        return self::PURPOSES[$purpose] ?? null;
    }


}
