<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ValueType
 *
 * @property int $id
 * @property string $value_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Settings $settings
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValueType whereValueName($value)
 * @mixin \Eloquent
 */
class ValueType extends Model
{
    protected $fillable = ['value_name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function settings()
    {
        return $this->belongsTo(Settings::class,'type_id','id');
    }
}
