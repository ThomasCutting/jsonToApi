<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DocumentEntity
 *
 * @property integer $id
 * @property integer $schema_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntity whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentEntity whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $points
 */
class DocumentEntity extends Model
{
    public $appends = [
        "points"
    ];

    public function getPointsAttribute()
    {
        return DocumentEntityPoint::whereEntityId($this->id)->get();
    }
}
