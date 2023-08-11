<?php

namespace App\Http\Resources\Tours;

use App\Http\Resources\Resource;

class TourResource extends Resource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
