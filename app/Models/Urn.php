<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Urn
 * @package App\Models
 *
 * @property integer $urn_specification_id
 * @property string $urn
 * @property
 */
class Urn extends Model
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
        'urn_specification_id',
        'urn',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function urnBatch()
    {
        return $this->belongsTo('App\Models\URNBatch');
    }

}
