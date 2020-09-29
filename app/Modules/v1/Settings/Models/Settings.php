<?php

namespace App\Modules\v1\Settings\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings
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
 * @property-read \App\Models\ValueType|null $valueType
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereValue($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    protected $fillable = ['name', 'value', 'default_value', 'description', 'type_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function valueType()
    {
        return $this->hasOne(ValueType::class, 'id', 'type_id');
    }
}
