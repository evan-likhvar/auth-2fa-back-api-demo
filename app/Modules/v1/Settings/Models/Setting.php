<?php

namespace App\Modules\v1\Settings\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\v1\Settings\Models\Settings
 *
 * @property int $id
 * @property string $name
 * @property string|null $value
 * @property string|null $default_value
 * @property string|null $description
 * @property int $type_id Тип значения
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read ValueType|null $valueType
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $fillable = ['name', 'value', 'default_value', 'description', 'type_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];



    public function valueType()
    {
        return $this->hasOne(ValueType::class, 'id', 'type_id');
    }
}
