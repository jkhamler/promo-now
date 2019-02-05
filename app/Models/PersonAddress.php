<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PersonAddress
 * @package App\Models
 * @property integer $person_id
 * @property integer $address_id
 * @property boolean $is_primary_address
 */
class PersonAddress extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    //
}
