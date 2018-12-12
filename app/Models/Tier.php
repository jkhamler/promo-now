<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Tier
 * @package App\Models
 *
 * @property integer $id
 * @property integer $level
 * @property string $short_description
 * @property string $long_description
 * @property integer $quantity
 *
 */
class Tier extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'level',
        'short_description',
        'long_description',
        'quantity',
    ];

}
