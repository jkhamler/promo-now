<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Promotion
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property \Carbon\Carbon $online_date
 * @property \Carbon\Carbon $promo_open_date
 * @property \Carbon\Carbon $promo_closed_date
 * @property \Carbon\Carbon $offline_date
 * @property boolean $urns_required
 * @property integer $urns_issued
 */
class Promotion extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'online_date',
        'promo_open_date',
        'promo_closed_date',
        'offline_date',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'description',
        'online_date',
        'promo_open_date',
        'promo_closed_date',
        'offline_date',
        'urns_required',
        'urns_issued',
    ];

    /**
     * @param Carbon $date
     * @return string
     */
    public static function dateFieldFormat(Carbon $date)
    {
        return $date->format('Y-m-d') . 'T' . $date->format('H:i');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiers(){
        return $this->hasMany('App\Models\Tier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mechanics(){
        return $this->hasMany('App\Models\Mechanic');
    }


}
