<?php

namespace App\Http\Resources\AccessControl;

use App\Http\Resources\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->pluck("name");
    }
}
