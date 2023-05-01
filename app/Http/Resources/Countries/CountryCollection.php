<?php

namespace App\Http\Resources\Countries;

use App\Http\Resources\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    public function toArray($request) : array
    {
        return $this->collection->toArray();
    }
}
