<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class FAQGroup
 * @package App\Models
 *
 * @property integer $promotion_id
 * @property string $name
 * @property string $description
 */
class FAQGroup extends Model
{
    protected $table = 'faq_groups';

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
    public function faqs()
    {
        $promoTerms = $this->hasMany('App\Models\FAQ', 'faq_group_id')->orderBy('order');

        return $promoTerms;
    }
}
