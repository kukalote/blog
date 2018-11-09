<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Menu extends Base
{
    const ENABLED = 0;

    const FOLDER = 1;
    const ITEM = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';
}
