<?php

namespace App\Modules\v1\UserShopModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShopType extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->hasMany(
            'App\Modules\v1\UserShopModule\Models\UserShop',
            'shop_type_id',
            'id'
        );
    }
}
