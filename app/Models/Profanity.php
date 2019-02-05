<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Profanity
 * @package App\Models
 *
 * @property integer $language_id
 * @property string $profanity
 */
class Profanity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'language_id',
        'profanity',
    ];
}
