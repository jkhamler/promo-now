<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mechanic
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $promotion_id
 * @property integer $tier_item_id
 * @property Carbon $start_datetime
 * @property Carbon $end_datetime
 * @property boolean $is_open
 * @property boolean $is_recyclable
 * @property integer $claim_window_duration_seconds
 * @property Carbon $claim_window_deadline
 * @property Carbon $draw_datetime
 * @property Carbon $draw_entrants_deadline
 * @property boolean $pi_to_generate_moments
 * @property integer $moment_duration_seconds
 * @property integer $moment_distribution_interval_seconds
 */
class Mechanic extends Model
{
    const MECHANIC_TYPE_WINNING_MOMENT = 'WINNING_MOMENT';
    const MECHANIC_TYPE_TIMED_DRAW = 'TIMED_DRAW';
    const MECHANIC_TYPE_EVERYBODY_GETS = 'EVERYBODY_GETS';
    const MECHANIC_TYPE_ITEM_PRIZE_SEEDING = 'ITEM_PRIZE_SEEDING';

    const MECHANIC_TYPES = [
        SELF::MECHANIC_TYPE_WINNING_MOMENT => 'Winning Moment',
        SELF::MECHANIC_TYPE_TIMED_DRAW => 'Timed Draw',
        SELF::MECHANIC_TYPE_EVERYBODY_GETS => 'Everybody Gets',
        SELF::MECHANIC_TYPE_ITEM_PRIZE_SEEDING => 'Item/Prize Seeding',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_datetime',
        'end_datetime',
        'claim_window_deadline',
        'draw_datetime',
        'draw_entrants_deadline',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'promotion_id',
        'tier_item_id',
        'start_datetime',
        'end_datetime',
        'is_open',
        'is_recyclable',
        'claim_window_duration_seconds',
        'claim_window_deadline',
        'draw_datetime',
        'draw_entrants_deadline',
        'pi_to_generate_moments',
        'moment_duration_seconds',
        'moment_distribution_interval_seconds',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }

    /**
     * @param null $type
     * @return string|null
     */
    public function getTypeLabel($type = null)
    {

        if (is_null($type)) {
            $type = $this->type;
        }
        return self::MECHANIC_TYPES[$type] ?? null;
    }


}
