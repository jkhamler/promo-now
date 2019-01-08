<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyTerm extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }
}
