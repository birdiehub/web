<?php

namespace App\Http\Resources\Tours;

use App\Http\Resources\ResourceCollection;

class TourCollection extends ResourceCollection
{
    public function toArray($request) : array
    {
        return $this->collection->toArray();
    }
}
