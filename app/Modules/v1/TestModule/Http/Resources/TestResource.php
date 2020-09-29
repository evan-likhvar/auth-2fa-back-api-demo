<?php

namespace App\Modules\v1\TestModule\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TestResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
