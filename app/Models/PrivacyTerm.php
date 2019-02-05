<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class PrivacyTerm
 * @package App\Models
 *
 * @property integer $version
 * @property integer $promotion_id
 * @property integer $partner_id
 * @property integer $authorised_by_user_id
 * @property \DateTime $authorised_at
 * @property string $title
 * @property string $acceptance_text
 * @property string $terms_body_text
 * @property string $marketing_opt_in
 * @property string $cookie_title
 * @property string $cookie_body_text
 * @property string $gdpr_contact_email
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property integer $created_by_user_id
 * @property integer $updated_by_user_id
 */
class PrivacyTerm extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $dates = [
        'authorised_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'version',
        'promotion_id',
        'partner_id',
        'authorised_by_user_id',
        'authorised_at',
        'title',
        'acceptance_text',
        'terms_body_text',
        'marketing_opt_in',
        'cookie_title',
        'cookie_body_text',
        'gdpr_contact_email',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    /**
     * @return bool
     */
    public function isLatestVersion(){
        return $this->version == $this->promotion->getMostRecentPrivacyTermVersion($this->partner_id);
    }


}
