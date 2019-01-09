<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class PromoTerm
 * @package App\Models
 *
 * @property integer $version
 * @property integer $promotion_id
 * @property \DateTime $valid_from
 * @property \DateTime $valid_until
 * @property integer $authorised_by_user_id
 * @property \DateTime $authorised_at
 * @property string $title
 * @property string $acceptance_text
 * @property string $short_terms
 * @property string $terms_body_text
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property integer $created_by_user_id
 * @property integer $updated_by_user_id
 */
class PromoTerm extends Model
{
    protected $dates = [
        'valid_from',
        'valid_until',
        'created_at',
        'updated_at',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'version',
        'promotion_id',
        'valid_from',
        'valid_until',
        'authorised_by_user_id',
        'authorised_at',
        'title',
        'acceptance_text',
        'short_terms',
        'terms_body_text',
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
