<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Partner
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $legal_name
 * @property string $description
 * @property string $company_number
 */
class Partner extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tierItems()
    {
        return $this->hasMany('App\Models\TierItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promoTerms()
    {
        return $this->hasMany('App\Models\PromoTerm');
    }


}
