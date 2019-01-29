<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Country
 * @package App\Models
 * @property string $name
 * @property string $iso_code
 */
class Country extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Country');
    }



}
