<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DocumentEntityPoint
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $type_id
 * @property integer $value_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereEntityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereValueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property-read mixed $type
 * @property-read mixed $value
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntityPoint whereName($value)
 */
class DocumentEntityPoint extends Model
{
    public $appends = [
        "type",
        "value"
    ];

    /**
     * @return mixed
     */
    public function getTypeAttribute()
    {
        return PointType::whereId($this->type_id)->first()->type_name;
    }

    /**
     * @return null
     */
    public function getValueAttribute()
    {
        $value = null;

        switch($this->type) {
            case "integer":
                $value = PointVaule::whereId($this->value_id)->first()->integer_value;
                break;
            case "float":
                $value = PointVaule::whereId($this->value_id)->first()->float_value;
                break;
            case "string":
                $value = PointVaule::whereId($this->value_id)->first()->string_value;
                break;
            case "boolean":
                $value = PointVaule::whereId($this->value_id)->first()->boolean_value;
                break;
            case "datetime":
                $value = PointVaule::whereId($this->value_id)->first()->datetime_value;
                break;
        }

        // Return the above value.
        return $value;
    }
}
