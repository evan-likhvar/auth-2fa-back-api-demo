<?php

namespace App\Modules\v1\UserShopModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_type_id', 'name'];

    public function type()
    {
        return $this->belongsTo(
            'App\Modules\v1\UserShopModule\Models\UserShopType',
            'shop_type_id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            'App\Models\User',
            'user_id',
            'id'
        );
    }
}
