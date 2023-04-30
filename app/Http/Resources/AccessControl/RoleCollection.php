<?php

namespace App\Http\Resources\AccessControl;

use App\Http\Resources\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            "data" => $this->collection->pluck("name")
        ];
    }
}
