<?php

namespace App\Http\Resources\AccessControl;

use App\Http\Resources\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->pluck('name')
        ];
    }
}
