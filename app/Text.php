<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:24
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *  Class Text
 * This is the model class for table "texts"
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $source
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class Text extends Model
{
    protected $table = 'texts';

    protected $hidden = ['source', 'created_at', 'updated_at'];
}