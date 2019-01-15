<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Entrant
 * @package App\Models
 *
 * @property integer $person_id
 * @property integer $urn_id
 * @property string $ip_address
 * @property string $user_agent
 */
class Entrant extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'person_id',
        'urn_id',
        'ip_address',
        'user_agent',
    ];
}
