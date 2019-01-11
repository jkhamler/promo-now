<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FAQ
 * @package App\Models
 *
 * @property integer $faq_group_id
 * @property string $title
 * @property string $body_text
 * @property integer $order
 */
class FAQ extends Model
{
    protected $table = 'faqs';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faqGroup()
    {
        return $this->belongsTo('App\Models\FAQGroup', 'faq_group_id');
    }
}
