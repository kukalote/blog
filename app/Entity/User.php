<?php

namespace App\Entity;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//class User extends Model
class User extends Authenticatable
{
    use Notifiable;

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
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nick_name', 'city_id'
    ];
}
