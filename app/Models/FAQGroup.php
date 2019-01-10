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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqs()
    {
        $promoTerms = $this->hasMany('App\Models\FAQ')->orderBy('version', 'desc');

        return $promoTerms;
    }
}
