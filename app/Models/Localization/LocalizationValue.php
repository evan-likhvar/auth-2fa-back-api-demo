<?php

namespace App\Models\Localization;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Localization\LocalizationValue
 *
 * @property-read \App\Models\Localization\LocalizationKey $key
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocalizationValue query()
 * @mixin \Eloquent
 */
class LocalizationValue extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'localization_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'localization_key_id',
        'locale',
        'value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function key()
    {
        return $this->belongsTo(LocalizationKey::class, 'localization_key_id', 'id');
    }

}
