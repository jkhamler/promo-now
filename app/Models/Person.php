<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Person
 * @package App
 *
 * @property string $first_name
 * @property string $surname
 * @property string $email_address
 */
class Person extends Model
{
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
    public static function findByEmailAddress($emailAddress){
        return self::where('email_address', $emailAddress)->first();
    }
}
