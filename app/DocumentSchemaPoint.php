<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DocumentSchemaPoint
 *
 * @property integer $id
 * @property integer $schema_id
 * @property integer $type_id
 * @property integer $value_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereValueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchemaPoint whereName($value)
 */
class DocumentSchemaPoint extends Model
{
    //
}
