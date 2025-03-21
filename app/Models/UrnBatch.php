<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class UrnBatch
 * @package App\Models
 *
 * @property integer $urn_specification_id
 * @property string $batch_name
 */
class UrnBatch extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function urnSpecification()
    {
        return $this->belongsTo('App\Models\URNSpecification');
    }


}
