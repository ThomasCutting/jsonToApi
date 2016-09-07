<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PointType
 *
 * @property integer $id
 * @property string $type_name
 * @property integer $default_value_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PointType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PointType whereTypeName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PointType whereDefaultValueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PointType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PointType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PointType extends Model
{
    //
}
