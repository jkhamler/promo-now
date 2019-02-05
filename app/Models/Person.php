<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Person
 * @package App
 *
 * @property string $first_name
 * @property string $surname
 * @property string $email_address
 */
class Person extends Model implements Auditable
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
        'first_name',
        'surname',
        'email_address',
    ];

    /**
     * @param $emailAddress
     * @return Person|null
     */
    public static function findByEmailAddress($emailAddress)
    {
        return self::where('email_address', $emailAddress)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entrants()
    {
        return $this->hasMany('App\Models\Entrant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany('App\Models\Address', 'person_addresses');
    }



    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->surname;
    }

    /**
     *
     *
     * @param int $charsToShow
     * @return string
     */
    public function emailMasked($charsToShow = 2)
    {
        $arr = explode('@', $this->email_address);

        return
            substr($arr[0], 0, $charsToShow) .
            str_repeat('*', strlen($arr[0]) - $charsToShow) .
            '@' . substr($arr[1], 0, $charsToShow) .
            str_repeat('*', strlen($arr[1]) - $charsToShow);
    }


}
