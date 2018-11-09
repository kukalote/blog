<?php

namespace App\Entity;

use App\Library\ModelExtra;
use App\Library\ModelTool;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use ModelTool;
    // disable update_at column;
    const UPDATED_AT = null;
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

}
