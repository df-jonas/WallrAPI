<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:21
 */

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 *  Class User
 * This is the model class for table "users"
 *
 * @property integer $id
 * @property string $device_name
 * @property string $device_uuid
 * @property string $device_verifytoken
 * @property string $api_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable
{
    protected $table = 'users';

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    protected $hidden = ['id', 'api_token', 'device_uuid', 'device_verifytoken', 'created_at', 'updated_at'];
}
