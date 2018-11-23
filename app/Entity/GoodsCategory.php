<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class GoodsCategory extends Base
{

    const NO_DELETED = 1;
    const IS_DELETED = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods_category';
}
