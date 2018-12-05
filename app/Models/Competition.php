<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property \Carbon\Carbon $online_date
 * @property \Carbon\Carbon $promo_open_date
 * @property \Carbon\Carbon $promo_closed_date
 * @property \Carbon\Carbon $offline_date
 * @property integer $urns_issued
 */
class Competition extends Model
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
        'urns_issued',
    ];


}
