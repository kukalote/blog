<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class DvSsCbdDay extends Model
{

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dv_ss_cbd_day';
}
