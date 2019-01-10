<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrnBatch extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function urns()
    {
        return $this->hasMany('App\Models\URN');
    }
}
