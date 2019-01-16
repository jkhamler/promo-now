<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Urn
 * @package App\Models
 *
 * @property integer $urn_specification_id
 * @property integer $urn_batch_id
 * @property string $urn
 * @property \DateTime $redeemed_at
 * @property
 */
class Urn extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'redeemed_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'urn_batch_id',
        'urn',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function urnBatch()
    {
        return $this->belongsTo('App\Models\URNBatch');
    }

    /**
     * @param $urn
     * @return Urn|null
     */
    public static function findByUrn($urn){
        return self::where('urn', $urn)->first();
    }

}
