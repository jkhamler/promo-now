<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Partner
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 */
class Partner extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
