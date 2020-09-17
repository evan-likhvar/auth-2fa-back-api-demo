<?php

namespace App\Models\Localization;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Localization\LocalizationKey
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Localization\LocalizationValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationKey query()
 * @mixin \Eloquent
 */
class LocalizationKey extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'localization_keys';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function values()
    {
        return $this->hasMany(LocalizationValue::class, 'localization_key_id', 'id');
    }

}
