<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UrnBatch
 * @package App\Models
 *
 * @property integer $urn_specification_id
 * @property string $batch_name
 */
class UrnBatch extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'urn_specification_id',
        'batch_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function urns()
    {
        return $this->hasMany('App\Models\URN');
    }
}
