<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    // disable update_at column;
    const UPDATED_AT = null;
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

}
