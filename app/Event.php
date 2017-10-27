<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:23
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *  Class Event
 * This is the model class for table "events"
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $public_event_id
 * @property string $created_at
 * @property string $updated_at
 */
class Event extends Model
{
    protected $table = 'events';

    public function texts()
    {
        return $this->hasMany('App\Text');
    }

    protected $hidden = ['user_id'];
}