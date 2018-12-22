<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Language
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $iso_code
 *
 */
class Language extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
    ];
}
