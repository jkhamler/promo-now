<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 *
 * @property string $name
 * @property string $first_name
 * @property string $surname
 * @property string $email
 * @property \DateTime gdpr_verified_at
 * @property \DateTime gdpr_expires_at
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    const GDPR_CERTIFIED = 'GDPR_CERTIFIED';
    const GDPR_NOT_CERTIFIED = 'GDPR_NOT_CERTIFIED';
    const GDPR_EXPIRED = 'GDPR_EXPIRED';
    const GDPR_EXPIRES_SOON = 'GDPR_EXPIRES_SOON';

    const GDPR_CERTIFICATION_STATUSES = [
        SELF::GDPR_CERTIFIED => 'GDPR Certified',
        SELF::GDPR_NOT_CERTIFIED => 'GDPR Not Certified',
        SELF::GDPR_EXPIRED => 'GDPR Certification Expired',
        SELF::GDPR_EXPIRES_SOON => 'GDPR Expires Soon',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'gdpr_verified_at',
        'gdpr_expires_at',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->surname;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    /**
     * @return mixed
     */
    public function getGDPRCertificationStatus()
    {
        $now = new \DateTime();

        $threeMonthsFromNow = clone $now;
        $threeMonthsFromNow->modify('+3 Months');

        if (!$this->gdpr_verified_at) {
            return self::GDPR_NOT_CERTIFIED;
        }

        elseif (isset($this->gdpr_expires_at) && $this->gdpr_expires_at < $now) {
            return self::GDPR_EXPIRED;
        } elseif (isset($this->gdpr_expires_at) && $this->gdpr_expires_at < $threeMonthsFromNow) {
            return self::GDPR_EXPIRES_SOON;
        } else {
            return self::GDPR_CERTIFIED;
        }
    }

    /**
     * @param $certificationStatus
     * @return string
     */
    public function getGDPRCertificationStatusLabel($certificationStatus)
    {
        return self::GDPR_CERTIFICATION_STATUSES($certificationStatus) ?? '';
    }
}