<?php

namespace App\Http\Resources\Countries;

use App\Http\Resources\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    public function toArray($request) : array
    {
        return [
            'data' => $this->collection->map(function ($country)  {
                return new CountryResource($country, $this->_language);
            })
        ];
    }
}
