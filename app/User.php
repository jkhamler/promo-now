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
 * @property string $password
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

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
    public function isSuperAdmin(){
        return $this->hasRole('super-admin');
    }

}
