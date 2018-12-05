<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
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
