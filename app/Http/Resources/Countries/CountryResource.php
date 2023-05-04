<?php

namespace App\Http\Resources\Countries;

use App\Http\Resources\Resource;

class CountryResource extends Resource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->translate('name'),
            'flag' => $this->flag
        ];
    }
}
