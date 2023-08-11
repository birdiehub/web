<?php

namespace App\Http\Resources\Permissions;

use App\Http\Resources\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->pluck('name');
    }
}
