<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    const MECHANIC_TYPE_WINNING_MOMENT = 'WINNING_MOMENT';
    const MECHANIC_TYPE_TIMED_DRAW = 'TIMED_DRAW';
    const MECHANIC_TYPE_EVERYBODY_GETS = 'EVERYBODY_GETS';
    const MECHANIC_TYPE_ITEM_PRIZE_SEEDING = 'ITEM_PRIZE_SEEDING';

    const MECHANIC_TYPES = [
        SELF::MECHANIC_TYPE_WINNING_MOMENT,
        SELF::MECHANIC_TYPE_TIMED_DRAW,
        SELF::MECHANIC_TYPE_EVERYBODY_GETS,
        SELF::MECHANIC_TYPE_ITEM_PRIZE_SEEDING,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }


}
