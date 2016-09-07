<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DocumentSchema
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $token
 * @property integer $owner_id
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DocumentSchema whereOwnerId($value)
 */
class DocumentSchema extends Model
{
    //
}
