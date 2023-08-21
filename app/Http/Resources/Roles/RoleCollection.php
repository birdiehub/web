<?php

namespace App\Http\Resources\Roles;

use App\Http\Resources\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->pluck("name");
    }
}
